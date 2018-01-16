<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stuff`.
 * Has foreign keys to the tables:
 *
 * - `bin`
 */
class m180107_210724_create_stuff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('stuff', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'bin_id' => $this->integer(),
        ]);

        // creates index for column `bin_id`
        $this->createIndex(
            'idx-stuff-bin_id',
            'stuff',
            'bin_id'
        );

        // add foreign key for table `bin`
        $this->addForeignKey(
            'fk-stuff-bin_id',
            'stuff',
            'bin_id',
            'bin',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `bin`
        $this->dropForeignKey(
            'fk-stuff-bin_id',
            'stuff'
        );

        // drops index for column `bin_id`
        $this->dropIndex(
            'idx-stuff-bin_id',
            'stuff'
        );

        $this->dropTable('stuff');
    }
}
