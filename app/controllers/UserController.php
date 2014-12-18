<?php
use \Illuminate\Support\MessageBag;

class UserController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
        Validator::extend('level_check', function($attribute, $value, $parameters)
		{
		    return Auth::user()->level >= $value;
		});
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
				'level' => 'required|integer|level_check'
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
		return View::make('user.edit')->with('user', $user);
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

		$validator = Validator::make(
			Input::all(), 
			Array(
				'name' => 'required',
				'surname' => 'required',
				'password' => 'confirmed|min:6',
				'level' => 'required|integer|level_check'
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$user->name = Input::get('name');
		$user->surname = Input::get('surname');
		$user->level = Input::get('level');

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
