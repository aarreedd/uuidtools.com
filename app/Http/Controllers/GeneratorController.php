<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Count;
use Cache;

class GeneratorController extends Controller
{
	function bulk()
	{
		return view('bulk-generator');
	}

	function index()
	{
		return view('generator-index');
	}

	function decode()
	{
		return view('decode');
	}

	function showGenerator($version = 'default')
	{
		$versions = [
			'default' => [
				'api' => 'v1',
				'title' => 'UUID Generator Tool',
				'dropdownSelected' => 'Version-1 UUID',
				'url' => '/',
				'description' => 'Free online UUID/GUID Generator. Create UUIDs according to RFC 4122 instantly.',
				'canonical' => 'https://www.uuidtools.com',
				'meta_title' => 'UUIDTools.com: Online UUID Generator',
			],
			'v1' => [
				'api' => 'v1',
				'title' => 'UUID Version-1 Generator Tool',
				'dropdownSelected' => 'Version-1 UUID',
				'url' => '/generator/v1',
				'description' => 'Free online UUID v1 Generator. Create version-1 UUIDs according to RFC 4122 instantly. Version-1 UUIDs are based on time and MAC Address.',
				'canonical' => 'https://www.uuidtools.com',
				'meta_title' => 'Online UUID (v1) Generator | UUIDTools.com',
			],
			'v3' => [
				'api' => 'v3',
				'title' => 'UUID Version-3 Generator Tool',
				'dropdownSelected' => 'Version-3 UUID',
				'url' => '/generator/v3',
				'description' => 'Free online UUID v3 Generator. Create version-3 UUIDs according to RFC 4122 instantly. Version-3 UUIDs are based on MD5 hash of a namespace and name.',
				'canonical' => 'https://www.uuidtools.com/generate/v3',
				'meta_title' => 'Online UUID (v3) Generator | UUIDTools.com',
			],
			'v4' => [
				'api' => 'v4',
				'title' => 'UUID Version-4 Generator Tool',
				'dropdownSelected' => 'Version-4 UUID',
				'url' => '/generator/v4',
				'description' => 'Free online UUID v4 Generator (Random UUID). Create version-4 UUIDs according to RFC 4122 instantly. Version-4 UUIDs are randomly generated on-the-fly.',
				'canonical' => 'https://www.uuidtools.com/generate/v4',
				'meta_title' => 'Online UUID (v4) Generator | UUIDTools.com',
			],
			'v5' => [
				'api' => 'v5',
				'title' => 'UUID Version-5 Generator Tool',
				'dropdownSelected' => 'Version-5 UUID',
				'url' => '/generator/v5',
				'description' => 'Free online UUID v5 Generator. Create version-5 UUIDs according to RFC 4122 instantly. Version-5 UUIDs are based on SHA-1 hash of a namespace and name.',
				'canonical' => 'https://www.uuidtools.com/generate/v5',
			],
			'timestamp-first' => [
				'api' => 'timestamp-first',
				'title' => 'Timestamp-First UUID Generator Tool',
				'dropdownSelected' => 'Timestamp First UUID',
				'url' => '/generator/timestamp-first',
				'description' => 'Free online time-based UUID Generator. Create ordered, timestamp-first UUIDs instantly. Ordered UUIDs are designed for efficient storage in indexed database columns.',
				'canonical' => 'https://www.uuidtools.com/generate/timestamp-first',
				'meta_title' => 'Online UUID (time-based) Generator | UUIDTools.com',
			]
		];

		if (!collect($versions)->keys()->contains($version))
		{
			abort(404);
		}


		$version = (object) $versions[$version];

		$otherOptions = collect($versions)->forget(['default'])
										->whereNotIn('dropdownSelected', [$version->dropdownSelected])
										->unique('dropdownSelected');

		// Database total + running total in cache...
		$count = Count::where('key', 'total-uuids')->first();
		$totalUuids = optional($count)->value + Cache::get('total-uuids', 0);

		return view('generator', compact('version', 'otherOptions', 'totalUuids'));
	}
}
