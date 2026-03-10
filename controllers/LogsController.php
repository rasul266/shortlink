<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\LinkLog;

class LogsController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LinkLog::find()->with('link')->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 50
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}