<?php

namespace app\services;

use app\models\LinkLog;
use Yii;

class LogService
{
    public function logClick(int $linkId): void
    {
        $log = new LinkLog();
        $log->link_id = $linkId;
        $log->ip = Yii::$app->request->userIP;
        $log->created_at = time();
        $log->save();
    }
}