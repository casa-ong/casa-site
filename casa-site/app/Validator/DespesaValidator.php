<?php

namespace App\Validator;
use App\Http\Requests\DespesaRequest;
use Illuminate\Support\Facades\Validator;

class DespesaValidator
{
    public static function validate($data)
    {
        $request = new DespesaRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());
        if(!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, "Erro na validação da despesa.");
        }

        return $validator;
    }
}