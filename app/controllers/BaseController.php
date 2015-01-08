<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Check if user have permission to access method.
	 *
	 * @param int $level
	 * @return void
	 */
	protected function checkPermission($level)
	{
		if (Auth::user()->level < $level) {
			return false;
		}
		return true;
	}

	/**
	 * Check if user have permission to access method, or if he is
	 * the owner of desired resource.
	 *
	 * @param int $level
	 * @param int $user_id
	 * @return void
	 */
	protected function checkPermissionOrMe($level, $user_id)
	{
		if (Auth::user()->level < $level && Auth::user()->id !== $user_id) {
			return false;
		}
		return true;
	}



}
