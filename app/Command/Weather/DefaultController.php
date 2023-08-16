<?php

namespace App\Command\Weather;

use App\Integration\Cptec;
use Minicli\Command\CommandController;

class DefaultController extends CommandController
{

    private string $urn = 'cidade/_week_/codigo_da_localidade/_previsao_.xml';
    private string $cityCode;

    public function make(): void
    {
        $this->cityCode = $this->getParam('cityCode');
        $this->urn = str_replace('codigo_da_localidade', $this->cityCode, $this->urn);
        $this->hasFlag('week') ? $this->urn = str_replace('_week_', '7dias', $this->urn) : $this->urn = str_replace('_week_/', '', $this->urn);
        $this->hasFlag('extend') ? $this->urn = str_replace('_previsao_', 'estendida', $this->urn) : $this->urn = str_replace('_previsao_', 'previsao', $this->urn);
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