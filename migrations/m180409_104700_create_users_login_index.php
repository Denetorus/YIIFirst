<?php

use yii\db\Migration;

/**
 * Class m180409_104700_create_users_login_index
 */
class m180409_104700_create_users_login_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex("ix_users_login", "users", 'login');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex("ix_users_login", "users");
    }
}
