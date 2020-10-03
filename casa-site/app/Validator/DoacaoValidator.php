<?php

namespace App\Validator;
use App\Http\Requests\DoacaoRequest;
use Illuminate\Support\Facades\Validator;

class DoacaoValidator
{
    public static function validate($data)
    {
        $request = new DoacaoRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        if(!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, "Erro na validação da doação.");
        }

        return $validator;
    }
}