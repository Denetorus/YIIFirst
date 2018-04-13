<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m180413_161854_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'description' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk_tasks_users',
            'tasks', 'user_id',
            'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}
