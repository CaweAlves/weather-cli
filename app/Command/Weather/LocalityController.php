<?php

namespace App\Command\Weather;

use App\Integration\Cptec;
use Minicli\Command\CommandController;

class LocalityController extends CommandController
{

    private string $urn = 'listaCidades?city=';


    public function handle(): void
    {
        $client = new Cptec($this->urn . $this->getParam('city'));

        $weather = $client->getWeather();
        var_dump($weather);
        $this->display("locality weather command controller");
    }
}