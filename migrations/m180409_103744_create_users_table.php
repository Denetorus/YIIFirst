<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180409_103744_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' =>$this->string(20),
            'password' =>$this->string(20)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
