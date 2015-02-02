<?php

class ReportController extends BaseController {
	public function edit($date)
	{
		$id = Input::get('id');
		return View::make('user.report_edit')->with('date',$date)->with('id',$id);
	}
	public function store()
	{
		$action = Input::get('submit');
		if($action == "Editar" || $action == "Apagar"){

			if($action == "Apagar"){
				$report = Timetables::where('user_id',Input::get('id'))->where('date',Input::get('date'))->first();
				$report->delete();
				return Redirect::route('user.report', array('id'=>Input::get('id')));
			}

			$validator = Validator::make(
			Input::all(),
			array(
				'time_in'=>'required|TimeFormat',
				'time_out'=>'required|TimeFormat'
			)
			);

			if ($validator->fails())
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
			$report = Timetables::where('user_id',Input::get('id'))->where('date',Input::get('date'))->first();
			$report->time_in = Input::get('time_in');
			$report->time_out = Input::get('time_out');
			$report->save();

			return Redirect::route('user.report', array('id'=>Input::get('id')));
		
		}else if($action == "Adicionar"){
			$validator = Validator::make(
			Input::all(),
			array(
				'time_in'=>'required|TimeFormat',
				'time_out'=>'required|TimeFormat'
			)
			);

			if ($validator->fails())
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}

			$report = new Timetables;
			$report->user_id = Input::get('id');
			$report->date = Input::get('date');
			$report->time_in = Input::get('time_in');
			$report->time_out = Input::get('time_out');
			$report->justification = null;
			$report->save();

			return Redirect::route('user.report', array('id'=>Input::get('id')));

		}
	}
}
