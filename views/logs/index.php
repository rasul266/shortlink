<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="container">
    <h1>Логи переходов</h1>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [

                [
                    'label' => 'ID',
                    'value' => function ($model) {
                        return $model->id;
                    }
                ],

                [
                    'label' => 'Оригинальная ссылка',
                    'format' => 'raw',
                    'value' => function ($model) {

                        $url = $model->link->original_url;

                        return Html::a($url, $url, ['target' => '_blank']);
                    }
                ],

                [
                    'label' => 'Короткая ссылка',
                    'format' => 'raw',
                    'value' => function ($model) {

                        $url = Yii::$app->request->hostInfo . '/r/' . $model->link->short_code;

                        return Html::a($url, $url, ['target' => '_blank']);
                    }
                ],

                [
                    'label' => 'Клики',
                    'value' => function ($model) {
                        return $model->link->clicks ?? 0;
                    }
                ],

                [
                    'label' => 'ip',
                    'value' => function ($model) {
                        return $model->ip;
                    }
                ],

                [
                    'label' => 'Создано',
                    'value' => function ($model) {
                        return date('Y-m-d H:i:s', $model->created_at);
                    }
                ]
            ]
        ]); ?>
    </div>
</div>
