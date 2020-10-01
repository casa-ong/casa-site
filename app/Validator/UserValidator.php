<?php

namespace App\Validator;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserValidator
{
    public static function validate($data)
    {
        $request = new CreateUserRequest();
        
        $validator = Validator::make($data, $request->rules(), $request->messages());
        if(!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, "Erro na validação do voluntário.");
        }

        return $validator;
    }
}