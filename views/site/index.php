<?php

/** @var yii\web\View $this */

$this->registerJsFile(
    '@web/js/link.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
<div class="site-index">
    <div class="container">
        <h2>Сервис коротких ссылок</h2>

        <div class="col-md-6 col-xs-12">
            <input type="text" id="url" class="form-control" placeholder="Введите URL" required>

            <button id="generate" class="btn btn-primary mt-2">
                ОК
            </button>

            <div id="result" class="mt-4"></div>
        </div>
    </div>
</div>
