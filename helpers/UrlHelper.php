<?php

namespace app\helpers;

class UrlHelper
{
    public static function checkUrl($url) : bool // Проверяем доступность URL
    {
        $headers = @get_headers($url);

        if ($headers && strpos($headers[0], '200')) {
            return true;
        }

        return false;
    }
}