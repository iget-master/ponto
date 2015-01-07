<?php

/*
|--------------------------------------------------------------------------
| Custom Validator Rules
|--------------------------------------------------------------------------
|
| Here is where you can register all of the custom validator rules for an
| application using Validator::Extend().
|
*/

/*
|--------------------------------------------------------------------------
| Level Check Validation
|--------------------------------------------------------------------------
|
| Verifica se o usuário atual tem permissão para definir uma permissão.
|
*/

Validator::extend('level_check', function($attribute, $value, $parameters)
{
    return Auth::user()->level >= $value;
});

/*
|--------------------------------------------------------------------------
| Validação de Formato de Hora
|--------------------------------------------------------------------------
|
| Verifica se o valor é uma hora válida
|
*/

Validator::extend('TimeFormat', function($attribute, $value, $parameters){
	if ((!preg_match('/^([0-2]?\d{1}):(\d{2})$/', $value, $results)) || (($results[1] > 23) || ($results[2] > 59))) {
		return false;
	} else {
		return true;
	}
});