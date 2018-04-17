<?php

use yii\db\Migration;

/**
 * Class m180417_152023_addcolumn_tasks_update
 */
class m180417_152023_addcolumn_tasks_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('tasks', 'created_at', $this->dateTime());
        $this->addColumn('tasks', 'updated_at', $this->dateTime());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'created_at');
        $this->dropColumn('tasks', 'updated_at');

        return false;
    }


}
