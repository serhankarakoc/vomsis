<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    // Hata mesajını döndürür.
    public function render($request)
    {
        return response()->json(['error' => $this->getMessage()], 400);
    }
}
