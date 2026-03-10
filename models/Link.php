<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $original_url
 * @property string $short_code
 * @property int $clicks
 * @property int $created_at
 */
class Link extends ActiveRecord
{
    public static function tableName() : string
    {
        return 'links';
    }

    public function rules() : array
    {
        return [
            [['original_url'], 'required'],
            [['original_url'], 'url'],
        ];
    }

    public static function generateCode($length = 6) : string
    {
        return substr(md5(uniqid()), 0, $length);
    }
}