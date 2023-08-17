<?php

namespace App\Command\Weather;

use App\Integration\Cptec;
use Minicli\Command\CommandController;
use Minicli\Output\Filter\ColorOutputFilter;
use Minicli\Output\Helper\TableHelper;

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

        $this->display("Search weather from {$weather['nome']} - {$weather['uf']}");

        $table = new TableHelper();
        $table->addHeader(['Dia', 'Tempo', 'Minima', 'Maxima']);

        foreach ($weather['previsao'] as $previsao) {
            $table->addRow([$previsao['dia'], $previsao['tempo'], $previsao['minima'] ,$previsao['maxima']]);
        }


        $this->newline();
        $this->rawOutput($table->getFormattedTable(new ColorOutputFilter()));
        $this->newline();

    }
}