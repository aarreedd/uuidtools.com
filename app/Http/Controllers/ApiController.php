<?php

namespace App\Http\Controllers;

use Str;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\UuidNamespace;

use Ramsey\Uuid\Uuid;

class ApiController extends Controller
{
	function version1($count = 1)
	{
		$validator = Validator::make(compact('count'), [
			'count' => 'numeric|between:1,100',
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		$output = [];
		for ($i = 0; $i < $count; $i++)
		{
			$output[] = (string) Uuid::uuid1();
		}

		Cache::increment('total-uuids', $count);

		return $output;
	}

	function version2($count = 1)
	{
		$validator = Validator::make(compact('count'), [
			'count' => 'numeric|between:1,100',
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		$output = [];
		for ($i = 0; $i < $count; $i++)
		{
			$output[] = (string) Uuid::uuid2(Uuid::DCE_DOMAIN_PERSON);
		}

		Cache::increment('total-uuids', $count);

		return $output;
	}

	function version3($namespace, $name)
	{
		$namespace = strtolower($namespace);

		$validator = Validator::make(compact('namespace', 'name'), [
			'namespace' => ['required', new UuidNamespace],
			'name' => 'required'
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		$name = $this->base64Decode($name);

		// Get predefined namespace
		if ($namespace == "ns:dns") {
			$namespace = Uuid::NAMESPACE_DNS;
		} elseif ($namespace == "ns:url") {
			$namespace = Uuid::NAMESPACE_URL;
		} elseif ($namespace == "ns:x500") {
			$namespace = Uuid::NAMESPACE_X500;
		} elseif ($namespace == "ns:oid") {
			$namespace = Uuid::NAMESPACE_OID;
		}

		Cache::increment('total-uuids');

		return [(string) Uuid::uuid3($namespace, $name)];
	}

	function version4($count = 1)
	{
		$validator = Validator::make(compact('count'), [
			'count' => 'numeric|between:1,100',
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		$output = [];
		for ($i = 0; $i < $count; $i++)
		{
			$output[] = (string) Uuid::uuid4();
		}

		Cache::increment('total-uuids', $count);

		return $output;
	}

	function version5($namespace, $name)
	{
		$namespace = strtolower($namespace);

		$validator = Validator::make(compact('namespace', 'name'), [
			'namespace' => ['required', new UuidNamespace],
			'name' => 'required'
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		$name = $this->base64Decode($name);

		// Get predefined namespace
		if ($namespace == "ns:dns") {
			$namespace = Uuid::NAMESPACE_DNS;
		} elseif ($namespace == "ns:url") {
			$namespace = Uuid::NAMESPACE_URL;
		} elseif ($namespace == "ns:x500") {
			$namespace = Uuid::NAMESPACE_X500;
		} elseif ($namespace == "ns:oid") {
			$namespace = Uuid::NAMESPACE_OID;
		}

		Cache::increment('total-uuids');

		return [(string) Uuid::uuid5($namespace, $name)];
	}

	function timestampFirst($count = 1)
	{
		$validator = Validator::make(compact('count'), [
			'count' => 'numeric|between:1,100',
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		$output = [];
		for ($i = 0; $i < $count; $i++)
		{
			$output[] = Str::orderedUuid();
		}

		Cache::increment('total-uuids', $count);

		return $output;
	}

	function decode($uuid)
	{
		$validator = Validator::make(compact('uuid'), [
			'uuid' => 'required|uuid',
		]);

		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()], 400);
		}

		ob_start();
		passthru("uuid -d ".escapeshellarg($uuid));
		$output = trim(ob_get_clean());

		$json = $this->parseUuidDecodeResults($output);

		return $json;
	}

	private function parseUuidDecodeResults($input)
	{
		$rows = explode("\n", $input);

		$output = [];
		$output['encode'] = [];
		$output['encode']['STR'] = substr($rows[0], 17);
		$output['encode']['SIV'] = substr($rows[1], 17);

		$output['decode'] = [];
		$output['decode']['variant'] = substr($rows[2], 17);
		$output['decode']['version'] = substr($rows[3], 17);

		if (Str::contains($rows[4], 'time:'))
		{
			$output['decode']['contents'] = [];
			$output['decode']['contents']['time'] = substr($rows[4], 24);
			$output['decode']['contents']['clock'] = substr($rows[5], 24);
			$output['decode']['contents']['node'] = substr($rows[6], 24);
		}
		else
		{
			$output['decode']['contents'] = substr($rows[4], 17) . "\n" . substr($rows[5], 17);
		}

		return $output;
	}

	/**
	 * If string starts with "base64:" then
	 * treat it as a base 64 string and decode it.
	 * This is a solution to https://github.com/aarreedd/uuidtools.com/issues/30
	 */
	private function base64Decode($name)
	{
		if (Str::startsWith(strtolower($name), 'base64:'))
		{
			$name = explode(':', $name, 2)[1];
			$name = base64_decode($name);
		}

		return $name;
	}
}
