<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bin`.
 */
class m180107_210629_create_bin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bin', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
            'description' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('bin');
    }
}
