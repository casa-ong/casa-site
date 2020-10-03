<?php

namespace App\Validator;
use App\Http\Requests\ProjetoRequest;
use Illuminate\Support\Facades\Validator;

class ProjetoValidator
{
    public static function validate($data)
    {
        $request = new ProjetoRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        if(!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, "Erro na validação do projeto.");
        }

        return $validator;
    }
}