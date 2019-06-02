<?php

use yii\db\Migration;

/**
 * Class m190531_112652_create_table_kv_storage
 */
class m190531_112652_create_table_kv_storage extends Migration
{
    const tableName = '{{%kv_storage}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::tableName, [
            'key' => $this->string(128)->notNull(),
            'value' => $this->text(),
            'comment' => $this->text(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ], $tableOptions);

        $this->addPrimaryKey('pk_kv_storage_key',self::tableName,'key');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable(self::tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190531_112652_create_table_kv_storage cannot be reverted.\n";

        return false;
    }
    */
}
