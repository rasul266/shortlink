<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%links}}`.
 */
class m260310_155559_create_links_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('links', [
            'id' => $this->primaryKey(),
            'original_url' => $this->text()->notNull(),
            'short_code' => $this->string(20)->notNull()->unique(),
            'created_at' => $this->integer(),
            'clicks' => $this->integer()->defaultValue(0),
        ]);

        $this->createTable('link_logs', [
            'id' => $this->primaryKey(),
            'link_id' => $this->integer(),
            'ip' => $this->string(50),
            'created_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-log-link',
            'link_logs',
            'link_id',
            'links',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('link_logs');
        $this->dropTable('links');
    }
}
