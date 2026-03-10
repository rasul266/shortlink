<?php

namespace app\services;

namespace app\services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QrService
{
    public function generate(string $url, string $filename): string
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($url)
            ->size(200)
            ->margin(10)
            ->build();

        $path = 'qr/' . $filename . '.png';

        $result->saveToFile(\Yii::getAlias('@webroot/' . $path));

        return '/' . $path;
    }
}