<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Timetables extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'timetables';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array('date','time_in','time_out','justification');

	public $timestamps = false;

	static public function getToday($user_id = null) {
		if (is_null($user_id)) {
			$user_id = Auth::user()->id;
		}
		return Timetables::where(['user_id'=>$user_id, 'date'=>date('Y-m-d')])->first();
	}

}