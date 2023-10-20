<?php
namespace App;

use GuzzleHttp\Client;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Api
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getPriceByDate(string $date): ?Bitcoin
    {
        $formattedDate = Carbon::parse($date)->toDateString();
        $url = "https://api.coindesk.com/v1/bpi/historical/close.json?start=$formattedDate&end=$formattedDate";

        $response = $this->client->get($url);
        $data = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);

        if (isset($data->bpi->$formattedDate)) {
            $price = (float) $data->bpi->$formattedDate;
            return new Bitcoin($formattedDate, $price);
        }

        return null;
    }
}
