<?php

namespace App\Helper;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AgeraHelper
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    public function numberOfProducts(): int
    {
        $url = 'https://dev14.ageraehandel.se/sv/api/product';
        $response = $this->client->request('GET', $url);

        $parsedResponse = $response->toArray();
        return count($parsedResponse['products']);
    }

    public function lowestPrice(): int
    {
        $url = 'https://dev14.ageraehandel.se/sv/api/product';
        $response = $this->client->request('GET', $url);

        $parsedResponse = $response->toArray();
        $priceArray = [];

      
        foreach($parsedResponse as $product)
        {
            foreach($product as $p)
            {
                array_push($priceArray, $p['pris']);
    
            }

        }

        $onlyValues = array_values($priceArray);

        $lowestPrice = min($onlyValues);

        return $lowestPrice;


    }

    public function maxPrice(): int
    {
        $url = 'https://dev14.ageraehandel.se/sv/api/product';
        $response = $this->client->request('GET', $url);

        $parsedResponse = $response->toArray();
        $priceArray = [];

      
        foreach($parsedResponse as $product)
        {
            foreach($product as $p)
            {
                array_push($priceArray, $p['pris']);
            }

        }

        $onlyValues = array_values($priceArray);

        $maxPrice = max($onlyValues);


        return $maxPrice;

    }

    public function allArticles(): array
    {
        $url = 'https://dev14.ageraehandel.se/sv/api/product';
        $response = $this->client->request('GET', $url);

        $data = $response->getContent();
        //$parsedResponse = $response->toArray();

        $decoded = json_decode($data)->products;


        //Funkar att skriva ut med echo
/*         foreach($decoded as $item)
        {
            
            echo $item->artikelkategorier_id;
            echo $item->artiklar_benamning;
        } */

        return $decoded;
    }

}