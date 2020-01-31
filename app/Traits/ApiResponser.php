<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code, $errors = null)
    {
        $ar_errors['errors'] = $message;
        if ($errors) {
            $ar_errors['message'] = $message;
            $ar_errors['errors'] = $errors;
        }
        $ar_errors['code'] = $code;
        
        return response()->json($ar_errors, $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $model, $code = 200)
    {
        return $this->successResponse($model, $code);
    }
}
