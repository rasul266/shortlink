<?php

namespace app\services;

use app\models\Link;
use Yii;

class LinkService
{
    private LogService $logService;

    public function __construct()
    {
        $this->logService = new LogService();
    }

    public function createShortLink(string $url): array
    {
        $this->validateUrl($url); // Проверяем валидность URL
        $this->checkAvailabilityUrl($url); // Проверяем доступность URL

        $link = new Link();
        $link->original_url = $url;
        $link->short_code = $this->generateCode();
        $link->created_at = time();

        if (!$link->save()) {
            throw new \Exception('Ошибка сохранения ссылки');
        }

        $shortUrl = Yii::$app->request->hostInfo . '/r/' . $link->short_code;

        return [
            'link' => $link,
            'short_url' => $shortUrl
        ];
    }

    public function getRedirectLink(string $code): string
    {
        $link = Link::findOne(['short_code' => $code]);

        if (!$link) {
            throw new \yii\web\NotFoundHttpException();
        }

        $link->updateCounters(['clicks' => 1]);

        $this->logService->logClick($link->id);

        return $link->original_url;
    }

    private function generateCode(int $length = 6): string
    {
        do {
            $code = substr(md5(uniqid()), 0, $length);
        } while (Link::find()->where(['short_code' => $code])->exists());

        return $code;
    }

    private function validateUrl(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('Невалидный URL');
        }
    }

    private function checkAvailabilityUrl(string $url): void
    {
        $headers = @get_headers($url);

        if (!$headers || strpos($headers[0], '200') === false) {
            throw new \Exception('Данный URL не доступен');
        }
    }
}