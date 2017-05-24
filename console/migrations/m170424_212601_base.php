<?php

use yii\db\Migration;

class m170424_212601_base extends Migration
{
    public function up()
    {
        $this->createTable('employee',[
            'id' => $this->primaryKey(11)->unique(),
            'user_id' => $this->integer(11)->unique()->notNull(),
            'first_name' => $this->string(128)->notNull(),
            'last_name' => $this->string(128)->notNull(),
            'function' => $this->string(128)->notNull(),
            'phone' => $this->string(128)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);

        $this->createIndex('employee_user_id','employee','user_id',true);
        $this->addForeignKey('emplyee_user_id_foreignkey','employee','user_id','user','id','cascade','no action');

    }

    public function down()
    {
        echo "m170424_212601_base cannot be reverted.\n";

        $this->dropIndex('employee_user_id','employee');
        $this->dropForeignKey('emplyee_user_id_foreignkey','employee');
        $this->dropTable('employee');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
