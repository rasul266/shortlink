<?php

namespace app\controllers;

use App\Helpers\UrlHelper;
use app\models\Link;
use app\services\LinkService;
use app\services\QrService;
use Endroid\QrCode\QrCode;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class LinkController extends Controller
{
    public function actionGenerate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $url = Yii::$app->request->post('url');

        $linkService = new LinkService();
        $qrService = new QrService();

        try {

            $result = $linkService->createShortLink($url);

            $qr = $qrService->generate(
                $result['short_url'],
                $result['link']->short_code
            );

            return [
                'short_url' => $result['short_url'],
                'qr' => $qr
            ];

        } catch (\Exception $e) {

            return [
                'error' => $e->getMessage()
            ];
        }
    }
}