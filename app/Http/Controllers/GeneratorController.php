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

	function home()
	{
		// Database total + running total in cache...
		$count = Count::where('key', 'total-uuids')->first();
		$totalUuids = optional($count)->value + Cache::get('total-uuids', 0);

		return view('home', compact('otherOptions', 'totalUuids'));
	}

	function index()
	{
		return view('generator-index');
	}

	function decode()
	{
		return view('decode');
	}

	function showGenerator($version)
	{
		$versions = [
			'v1' => [
				'api' => 'v1',
				'title' => 'UUID Version-1 Generator',
				'dropdownSelected' => 'Version-1 UUID',
				'url' => '/generator/v1',
				'description' => 'Free online UUID v1 Generator. Create version-1 UUIDs according to RFC 4122 instantly. Version-1 UUIDs are based on time and MAC Address.',
				'canonical' => 'https://www.uuidtools.com',
				'meta_title' => 'Online UUID (v1) Generator | UUIDTools.com',
			],
			'v3' => [
				'api' => 'v3',
				'title' => 'UUID Version-3 Generator',
				'dropdownSelected' => 'Version-3 UUID',
				'url' => '/generator/v3',
				'description' => 'Free online UUID v3 Generator. Create version-3 UUIDs according to RFC 4122 instantly. Version-3 UUIDs are based on MD5 hash of a namespace and name.',
				'canonical' => 'https://www.uuidtools.com/generate/v3',
				'meta_title' => 'Online UUID (v3) Generator | UUIDTools.com',
			],
			'v4' => [
				'api' => 'v4',
				'title' => 'UUID Version-4 ("Random") Generator',
				'dropdownSelected' => 'Version-4 UUID ("Random")',
				'url' => '/generator/v4',
				'description' => 'Free online UUID v4 Generator (Random UUID). Create version-4 UUIDs according to RFC 4122 instantly. Version-4 UUIDs are randomly generated on-the-fly.',
				'canonical' => 'https://www.uuidtools.com/generate/v4',
				'meta_title' => 'Random UUID (v4) Generator | UUIDTools.com',
			],
			'v5' => [
				'api' => 'v5',
				'title' => 'UUID Version-5 Generator',
				'dropdownSelected' => 'Version-5 UUID',
				'url' => '/generator/v5',
				'description' => 'Free online UUID v5 Generator. Create version-5 UUIDs according to RFC 4122 instantly. Version-5 UUIDs are based on SHA-1 hash of a namespace and name.',
				'canonical' => 'https://www.uuidtools.com/generate/v5',
				'meta_title' => 'Online UUID (v5) Generator | UUIDTools.com',
			],
			'timestamp-first' => [
				'api' => 'timestamp-first',
				'title' => 'Timestamp-First UUID Generator',
				'dropdownSelected' => 'Timestamp First UUID (For databases)',
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
