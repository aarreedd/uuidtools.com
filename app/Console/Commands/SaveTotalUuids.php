<?php

namespace App\Console\Commands;

use Cache;
use App\Count;
use Illuminate\Console\Command;

class SaveTotalUuids extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'uuidtools:save-total';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Takes the "total_uuids" cache key and adds it to the total in the database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$count = Count::where('key', 'total-uuids')->first();

		if (is_null($count)) {
			$count = new Count();
			$count->key = 'total-uuids';
			$count->value = 0;
			$count->save();
		}

		$count->value += Cache::get('total-uuids', 0);
		Cache::forget('total-uuids');
		$count->save();

		$this->info("Total UUIDs: " . $count->value);

		return 0;
	}
}
