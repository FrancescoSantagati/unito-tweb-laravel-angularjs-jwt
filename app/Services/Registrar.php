<?php namespace App\Services;

use App\User;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Validator;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'username' => 'required|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'email' => 'required|email|max:255|unique:users',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$data['password'] = bcrypt($data['password']);
		return User::create($data);
	}
}