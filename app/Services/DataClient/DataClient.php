<?php

namespace App\Services\DataClient;

class DataClient
{
    public static function getDrinks()
    {
        $client = app('DrinksApiClient');

        $response = $client->get('' );

        return json_decode($response->getBody()->getContents(), true);
    }
}
