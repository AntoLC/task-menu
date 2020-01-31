<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        $data = $this->cacheResponse($data);
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

    protected function cacheResponse($data)
    {
        $url = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);

        $queryString = http_build_query($queryParams);
        $fullUrl = $url."?".$queryString;

        return Cache::remember($fullUrl, $ttl=30, function () use ($data) {
            return $data;
        });
    }
}
