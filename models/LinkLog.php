<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $link_id
 * @property string $ip
 * @property int $created_at
 */
class LinkLog extends ActiveRecord
{
    public static function tableName() : string
    {
        return 'link_logs';
    }

    public function getLink() : \yii\db\ActiveQuery
    {
        return $this->hasOne(Link::class, ['id' => 'link_id']);
    }
}