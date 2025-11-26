<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use App\Models\User;

class CustomUserProvider extends EloquentUserProvider
{

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('password', $credentials))) {
            return;
        }

        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {

            if ($key === 'numero') {
                $query->where('numero', $value);
            } elseif ($key !== 'password') {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}
