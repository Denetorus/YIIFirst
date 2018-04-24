<?php

use yii\db\Migration;

/**
 * Handles the creation of table `file_field_tasks`.
 */
class m180424_150644_create_file_field_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'file', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'file');
    }
}
