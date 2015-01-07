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