<?php

namespace App\Validator;
use App\Http\Requests\SugestaoRequest;
use Illuminate\Support\Facades\Validator;

class SugestaoValidator
{
    public static function validate($data)
    {
        $request = new SugestaoRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        if(!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, "Erro na validação da sugestão.");
        }

        return $validator;
    }
}