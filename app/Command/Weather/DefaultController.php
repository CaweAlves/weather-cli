<?php

namespace App\Command\Weather;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        $this->display("weather command controller");
    }
}