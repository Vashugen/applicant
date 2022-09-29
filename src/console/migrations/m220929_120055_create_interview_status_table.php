<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%interview_status}}`.
 */
class m220929_120055_create_interview_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%interview_status}}', [
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
        $this->dropTable('{{%interview_status}}');
    }
}
