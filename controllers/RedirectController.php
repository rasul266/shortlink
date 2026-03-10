<?php

namespace app\controllers;

use app\models\Link;
use app\models\LinkLog;
use app\services\LinkService;
use Yii;
use yii\web\Controller;

class RedirectController extends Controller
{
    public function actionIndex($code)
    {
        $service = new LinkService();

        $url = $service->getRedirectLink($code);

        return $this->redirect($url);
    }
}