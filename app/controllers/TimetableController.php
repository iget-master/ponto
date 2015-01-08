<?php
use \Illuminate\Support\MessageBag;

class TimetableController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function arrival() {
    	$messages = new MessageBag();

    	if (is_null(Timetables::getToday())) {
    		$timetable = new Timetables();
    		$timetable->date = date('Y-m-d');
    		$timetable->user_id = Auth::user()->id;
    		$timetable->time_in = date('H:i');
    		$timetable->save();

            $time = date('H:i');
    		$messages->add('success', "Você entrou! (".$time.")");
    	} else {
    		$messages->add('danger', 'Ei! você não pode entrar duas vezes no mesmo dia!');
    	}

    	return Redirect::route('home.dashboard')->with('messages', $messages);
    }

    public function departure() {
    	$messages = new MessageBag();
    	$timetable = Timetables::getToday();
    	if (is_null($timetable)) {
    		$messages->add('danger', 'Ei! Você deveria ter entrado para poder sair né?!');
    	} else {
    		if (is_null($timetable->time_out)) {
	    		$timetable->time_out = date('H:i');
	    		$timetable->save();

                $time = date('H:i');
	    		$messages->add('success', "Você saiu!(".$time.")");
    		} else {
    			$messages->add('danger', 'Ei! Você já saiu hoje!');
    		}
    	}

    	return Redirect::route('home.dashboard')->with('messages', $messages);
    }

}
