<?php

namespace App\Integration;

class Cptec
{
    private string $base_url = 'http://servicos.cptec.inpe.br/XML/';

    public function __construct(private string $urn)
    {
        $this->urn = $urn;
    }

    public function getWeather()
    {
        $uri = $this->base_url . $this->urn;
        var_dump($uri);
        $xml = simplexml_load_file($uri);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }
}