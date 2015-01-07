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
	if(strpos($value,":") === false){
		//nao tem ":"
		return false;
	} else{
		//tem ":"
		if(strlen($value) < 4){
			//tem menos de 4 caracteres
			return false;
		} elseif(strlen($value) > 5){
			//tem mais de 5 caracteres
			return false;
		} else{
			//tem a quantidade certa de caracteres
			if(substr_count($value,":") > 1){
				//aparece ":" mais de 1x
				return false;
			} else{
				//aparece ":" apenas 1x
				return true;
			}
		}
	}
});