<?php

namespace App\Validator;
use App\Http\Requests\EnqueteRequest;
use Illuminate\Support\Facades\Validator;

class EnqueteValidator
{
    public static function validate($data)
    {
        $request = new EnqueteRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        if(!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, "Erro na validação da enquete.");
        }

        return $validator;
    }
}