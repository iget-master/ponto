<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function dashboard()
	{
		$timestamp = time();
		$month = date('m', $timestamp);
		$year = date('Y', $timestamp);
		$firstDayOfMonth = strtotime("01-${month}-${year}");
		$daysToBack = intval(date('w', $firstDayOfMonth));
		if ($daysToBack == 0) {
			$daysToBack = 7;
		}
		$firstDayOfCalendar = strtotime("-" . $daysToBack . " day", $firstDayOfMonth);
		//dd($firstDayOfCalendar, $firstDayOfMonth, $daysToBack);
		$calendar = [];

		$calendar["month_name"] = ucfirst(utf8_encode(strftime("%B", $timestamp)));
		$calendar["days"][] = ["date"=>$firstDayOfCalendar, "class"=>"disabled"];
		$calendarDayCount = 1;

		// Varre dias antes do início do mês.
		for ($i=1; $i < $daysToBack; $i++) { 
			$calendar["days"][] = ["date"=>strtotime("+${i} day", $firstDayOfCalendar), "class"=>"disabled"];
			$calendarDayCount++;
		}


		$usertimes = [];
		foreach (UsersTimes::getUserTimes() as $row) {
			$usertimes[$row->weekday] = $row;
		}


		// Varre dias do mês atual
		$dias = 0;
		$faltas = 0;
		$atrasos = 0;
		$horasTrabalhadas = 0;
		$worked_hours = 0;
		$worked_minutes = 0;
		$worked_mins = 0;

		for ($i=0; $i < intval(date('t', $timestamp)); $i++) {
			$day = strtotime("+${i} day", $firstDayOfMonth);
			$day_times = Timetables::getDay($day);
			$class = "";

			$pontual = true;
			$falta = false;

			if (isset($usertimes[date('w', $day)])) {
				$weekday_times = $usertimes[date('w', $day)];

				if ($day_times) {
					if ($day_times->time_in) {
						if (strtotime($day_times->time_in) > strtotime($weekday_times->time_in)) {
							$class = "success";
							$pontual = false;
						}
					} 
					if ($day_times->time_out) {
						if (strtotime($day_times->time_out) < strtotime($weekday_times->time_out)) {
							$class = "success";
							$pontual = false;
						}
					}
				} else if ($day < strtotime('tomorrow midnight')) {
					$class = "danger";
					$falta = true;
				}

				if ($day < strtotime('tomorrow midnight')) {
					$dias++;
					if ($falta) $faltas++;
					if (!$pontual) $atrasos++;
				}
			}
			$calendar["days"][] = ["date"=>$day, "class"=>$class, "timetable"=>$day_times];
			$calendarDayCount++;

			if($day_times){
				if($day_times->time_out != null){
					$hours = substr($day_times->time_out,0,-6) - substr($day_times->time_in,0,-6);
					$minutes = substr($day_times->time_out,3,-3) - substr($day_times->time_in,3,-3);
					$worked_hours += $hours;
					$worked_minutes += $minutes;
					while($worked_minutes >= 60){
						$worked_minutes -= 60;
						$worked_mins++;
					}
				}
			}

		}

		echo $horasTrabalhadas += $worked_hours;

		// Varre dias após o mês atual
		for ($i=1; $i <= (42 - $calendarDayCount); $i++) {
			$calendar["days"][] = ["date"=>strtotime("+${i} day", $day), "class"=>"disabled"];
		}

		$statistics = [];

		$statistics["dias"] = $dias;
		$statistics["dias_trabalhados"] = $dias - $faltas;
		$statistics["faltas"] = $faltas;
		$statistics["atrasos"] = $atrasos;
		$statistics["horasTrabalhadas"] = $horasTrabalhadas + $worked_mins;
		if ($statistics["dias_trabalhados"] == 0) {
			$statistics["pontualidade"] = "-";
		} else {
			$statistics["pontualidade"] = round((1 - ($statistics["atrasos"]) / $statistics["dias_trabalhados"]) * 100);
		}

		if ($statistics["dias"] == 0) {
			$statistics["presenca"] = "-";
		} else {
			$statistics["presenca"] = round(($statistics["dias_trabalhados"] / $statistics["dias"]) * 100);
		}

		return View::make('dashboard')->withCalendar($calendar)->withStatistics($statistics);
	}

}
