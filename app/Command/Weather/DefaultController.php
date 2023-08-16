<?php

namespace App\Command\Weather;

use App\Integration\Cptec;
use Minicli\Command\CommandController;

class DefaultController extends CommandController
{

    private string $urn = 'cidade/codigo_da_localidade/previsao.xml';
    private string $cityCode;

    public function make(): void
    {
        $this->cityCode = $this->getParam('cityCode');
        $this->urn = str_replace('codigo_da_localidade', $this->cityCode, $this->urn);
    }

    public function handle(): void
    {
        $this->make();
        $client = new Cptec($this->urn);

        $weather = $client->getWeather();
        var_dump($weather);
        $this->display("capitals weather command controller");
    }
}