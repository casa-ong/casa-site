<?php

namespace App\Util;

class SaveFileUtil
{
    public static function saveFile($file, $id, $dir)
    {
        $ex = $file->guessClientExtension(); //Define a extensao do arquivo
        $nomeAnexo = 'anexo_'.$id.'.'.$ex;
        $file->move($dir, $nomeAnexo); // Move o arquivo para o diretorio indicado
        $file = $dir.'/'.$nomeAnexo;
        return $file;
    }
}