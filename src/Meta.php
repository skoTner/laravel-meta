<?php

namespace Skotner\Meta;

use DB;
use Carbon\Carbon;

trait Meta {

	/**
	 * Get meta value based on provided key
	 * @param  string $key Meta key name
	 * @return string      Meta value of provided key
	 */
	public function getMeta($key) {
		return DB::table(config('meta.table_name'))
			->where([
				'model_type' => __CLASS__,
				'model_id'   => $this->id,
				'meta_key'   => $key
			])
			->first()->meta_value ?? null;
	}

	/**
	 * Set a meta tag wheter it exists or not.
	 * @param  array|string $meta  Pass either meta key single or array of meta keys
	 * @param  string       $value Optional value if key is passed single
	 * @return void
	 */
	public function setMeta($meta, $value = null) {
		$meta = (is_array($meta) ? $meta : $this->createArray($meta, $value));

		foreach($meta as $key => $value) {
			($this->getMeta($key)) ? $this->updateMeta($key, $value) : $this->createMeta($key, $value);
		}
	}

	/**
	 * Creates a new meta tag.
	 * @param  string $key   Meta key.
	 * @param  string $value Meta value.
	 * @return integer       1 = true / 0 = false
	 */
	public function createMeta($key, $value = null) {
		return DB::table(config('meta.table_name'))->insert([
			'model_id'   => $this->id,
			'model_type' => __CLASS__,
			'meta_key'   => $key,
			'meta_value' => $value,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
	}

	/**
	 * Updates a new meta tag.
	 * @param  string $key   Meta key.
	 * @param  string $value Meta value.
	 * @return integer       1 = true / 0 = false
	 */
	public function updateMeta($key, $value) {
		return DB::table(config('meta.table_name'))->where([
			'model_id'   => $this->id,
			'model_type' => __CLASS__,
			'meta_key'   => $key
		])->update([
			'meta_value' => $value,
			'updated_at' => Carbon::now()
		]);
	}

	/**
	 * Deletes provided meta key if exists.
	 * @param  string $key Meta key to be deleted
	 * @return integer     Rows deleted
	 */
	public function deleteMeta($key) {
		return DB::table(config('meta.table_name'))->where([
			'model_type' => __CLASS__,
			'model_id'   => $this->id,
			'meta_key'   => $key
		])->delete();
	}

	/**
	 * Converts meta key and value into an array and returns it.
	 * @param  string $meta  Meta key.
	 * @param  string $value Meta value.
	 * @return array
	 */
	protected function createArray($meta, $value) {
		return [$meta => $value];
	}

}