<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m220929_112110_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->comment('Наименование'),
            'external_id' => $this->integer(),
            'status' => $this->tinyInteger(1)->comment('Статус')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
