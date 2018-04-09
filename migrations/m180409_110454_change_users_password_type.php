<?php

use yii\db\Migration;
use app\models\Users;

/**
 * Class m180409_110454_change_users_password_type
 */
class m180409_110454_change_users_password_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn("users", "password");
        $this->addColumn('users', 'password', $this->string(32));

        $users = new Users();
        $users->login = "admin";
        $users->password = md5("admin");
        $users->save();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("users", "password");
        $this->addColumn('users', 'password', $this->string(20));
    }

}
