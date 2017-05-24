<?php

use yii\db\Migration;
use common\models\Notification;

class m170502_120717_notification extends Migration
{
    public function up()
    {
        $this->createTable('notification_type',[
            'id' => $this->primaryKey(11),
            'name' => $this->string(128),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);

        $this->createTable('notification',[
            'id' => $this->primaryKey(11),
            'type_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'status' => $this->integer(1)->defaultValue(Notification::STATUS_WAITING),
            'start_datetime' => $this->dateTime()->notNull(),
            'end_datetime' => $this->dateTime(),
            'description' => $this->text(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);

        $this->addForeignKey('notification_type_link','notification','type_id','notification_type','id','NO ACTION','NO ACTION');
        $this->addForeignKey('notification_user_id_foreignkey','notification','user_id','user','id','cascade','no action');
    }

    public function down()
    {
        $this->dropForeignKey('notification_type_link','notification');

        $this->dropTable('notification_type');
        $this->dropTable('notification');

        return true;
    }
}
