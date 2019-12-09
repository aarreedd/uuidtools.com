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


	function index($version = 'default')
	{
		$versions = [
			'default' => [
				'api' => 'v1',
				'title' => 'UUID Generator Tool',
				'dropdownSelected' => 'Version-1 UUID',
				'url' => '/',
			],
			'v1' => [
				'api' => 'v1',
				'title' => 'UUID Version-1 Generator Tool',
				'dropdownSelected' => 'Version-1 UUID',
				'url' => '/generator/v1',
			],
			'v3' => [
				'api' => 'v3',
				'title' => 'UUID Version-3 Generator Tool',
				'dropdownSelected' => 'Version-3 UUID',
				'url' => '/generator/v3',
			],
			'v4' => [
				'api' => 'v4',
				'title' => 'UUID Version-4 Generator Tool',
				'dropdownSelected' => 'Version-4 UUID',
				'url' => '/generator/v4',
			],
			'v5' => [
				'api' => 'v5',
				'title' => 'UUID Version-5 Generator Tool',
				'dropdownSelected' => 'Version-5 UUID',
				'url' => '/generator/v5',
			],
			'timestamp-first' => [
				'api' => 'timestamp-first',
				'title' => 'Timestamp-First UUID Generator Tool',
				'dropdownSelected' => 'Timestamp First UUID',
				'url' => '/generator/timestamp-first',
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


	function decode()
	{
		return view('decode');
	}
}
