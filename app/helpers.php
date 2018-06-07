<?php

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    function getNewApiKey() {
        $apiKey = random_str(32);
        while(\App\User::where('api_key', $apiKey)->count() > 0) {
            $apiKey = random_str(32);
        }
        return $apiKey;
    }
