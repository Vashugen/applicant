<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancy}}`.
 */
class m220929_120540_create_vacancy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->comment('Наименование'),
            'status' => $this->tinyInteger(1)->comment('Статус')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vacancy}}');
    }
}
