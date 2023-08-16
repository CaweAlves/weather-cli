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
        $url = $this->base_url . $this->urn;
        var_dump($url);
        $xml = simplexml_load_file($url);
        return $xml;
    }
}