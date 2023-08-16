<?php

namespace App\Command\Weather;

use App\Integration\Cptec;
use Minicli\Command\CommandController;

class CapitalsController extends CommandController
{

    private string $urn = 'capitais/condicoesAtuais.xml';


    public function handle(): void
    {
        $client = new Cptec($this->urn);

        $weather = $client->getWeather();
        var_dump($weather);
        $this->display("capitals weather command controller");
    }
}