<?php

use yii\db\Migration;

/**
 * Handles the creation of table `letters`.
 */
class m180417_142107_create_letters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('letters', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->string(255),
        ]);
        $this->createIndex("ix_letters_user", "letters", 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('letters');
    }
}
