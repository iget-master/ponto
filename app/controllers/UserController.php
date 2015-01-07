<?php
use \Illuminate\Support\MessageBag;

class UserController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::paginate(15);
		return View::make('user.index')->with('users', $users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(
			Input::all(), 
			Array(
				'name' => 'required',
				'surname' => 'required',
				'email' => 'required|email|unique:users',
				'password' => 'required|confirmed|min:6',
				'level' => 'required|integer|level_check',
				'day_0_time_in' => 'sometimes|required|TimeFormat',
				'day_0_time_out' => 'sometimes|required|TimeFormat',
				'day_1_time_in' => 'sometimes|required|TimeFormat',
				'day_1_time_out' => 'sometimes|required|TimeFormat',
				'day_2_time_in' => 'sometimes|required|TimeFormat',
				'day_2_time_out' => 'sometimes|required|TimeFormat',
				'day_3_time_in' => 'sometimes|required|TimeFormat',
				'day_3_time_out' => 'sometimes|required|TimeFormat',
				'day_4_time_in' => 'sometimes|required|TimeFormat',
				'day_4_time_out' => 'sometimes|required|TimeFormat',
				'day_5_time_in' => 'sometimes|required|TimeFormat',
				'day_5_time_out' => 'sometimes|required|TimeFormat',
				'day_6_time_in' => 'sometimes|required|TimeFormat',
				'day_6_time_out' => 'sometimes|required|TimeFormat'
			)
		);


		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$user = User::create(
			Array(
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'email' => Input::get('email'),
				'level' => Input::get('level'),
				'password' => Hash::make(Input::get('password'))
			)
		);
		for($n=0;$n<7;$n++){
			if(Input::get("day_check_$n") == 1){
				$weekday = new UsersTimes();
				$weekday->user_id = $user->id;
				$weekday->weekday = $n;
				$weekday->time_in = Input::get("day_".$n."_time_in");
				$weekday->time_out = Input::get("day_".$n."_time_out");
				$weekday->save();
			}
		}

		return Redirect::route('user.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		$response = View::make('user.edit')->with('user', $user);
		foreach(UsersTimes::where('user_id',$id)->get() AS $key){
			$response->with('day_' . $key->weekday . '_time_in', $key->time_in);
			$response->with('day_' . $key->weekday . '_time_out', $key->time_out);
		}
		return $response; 
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);
		$user_time = UsersTimes::where('user_id',$id);

		$validator = Validator::make(
			Input::all(), 
			Array(
				'name' => 'required',
				'surname' => 'required',
				'password' => 'confirmed|min:6',
				'level' => 'required|integer|level_check',
				'day_0_time_in' => 'sometimes|required|TimeFormat',
				'day_0_time_out' => 'sometimes|required|TimeFormat',
				'day_1_time_in' => 'sometimes|required|TimeFormat',
				'day_1_time_out' => 'sometimes|required|TimeFormat',
				'day_2_time_in' => 'sometimes|required|TimeFormat',
				'day_2_time_out' => 'sometimes|required|TimeFormat',
				'day_3_time_in' => 'sometimes|required|TimeFormat',
				'day_3_time_out' => 'sometimes|required|TimeFormat',
				'day_4_time_in' => 'sometimes|required|TimeFormat',
				'day_4_time_out' => 'sometimes|required|TimeFormat',
				'day_5_time_in' => 'sometimes|required|TimeFormat',
				'day_5_time_out' => 'sometimes|required|TimeFormat',
				'day_6_time_in' => 'sometimes|required|TimeFormat',
				'day_6_time_out' => 'sometimes|required|TimeFormat'
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$user->name = Input::get('name');
		$user->surname = Input::get('surname');
		$user->level = Input::get('level');


		for($n=0;$n<7;$n++){
			if ( (Input::get("day_check_$n") == 1) && (Input::has(array("day_${n}_time_in", "day_${n}_time_out"))) ) {
				UsersTimes::where('user_id', $id)->where('weekday', $n)->delete();

				$weekday = new UsersTimes();
				$weekday->user_id = $id;
				$weekday->weekday = $n;
				$weekday->time_in = Input::get("day_".$n."_time_in");
				$weekday->time_out = Input::get("day_".$n."_time_out");
				$weekday->save();
			} else {
				$weekday = UsersTimes::where('user_id', $id)->where('weekday', $n)->delete();
			}
		}


				
/*
		$user_time->where('weekday', 0)->time_in = Input::get('day_0_time_in');
			$user_time->where('weekday', 0)->time_out = Input::get('day_0_time_out');
		
		$user_time-> = Input::get('day_check_1');
		$user_time-> = Input::get('day_check_2');
		$user_time-> = Input::get('day_check_3');
		$user_time-> = Input::get('day_check_4');
		$user_time-> = Input::get('day_check_5');
		$user_time-> = Input::get('day_check_6');
*/
		if (strlen(Input::get('password'))) {
			$user->password = Hash::make(Input::get('password'));
		}

		$user->save();

		$messages = with(new MessageBag())->add('success', 'Usuário modificado com sucesso!');

		return Redirect::route('user.index')->with('messages', $messages);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
