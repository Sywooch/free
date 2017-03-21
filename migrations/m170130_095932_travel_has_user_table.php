<?php

use yii\db\Migration;

class m170130_095932_travel_has_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('travel_has_user', [
            'travel_id' => $this->integer()->unsigned()->notNull()->comment('ссылка на маршрут'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('ссылка на пользователя'),
        ],
            'ENGINE = InnoDB COMMENT = \'связь путешествие -  участник\'');

        $this->addPrimaryKey('pk', 'travel_has_user', ['travel_id', 'user_id']);
        $this->createIndex('fk_travel_has_user_user1_idx', 'travel_has_user', 'user_id');
        $this->createIndex('fk_travel_has_user_travel_idx', 'travel_has_user', 'travel_id');

        $this->addForeignKey('fk_travel_has_user_travel1', 'travel_has_user', 'travel_id', 'travel', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_travel_has_user_user1', 'travel_has_user', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function safeDown()
    {
        $this->dropTable('travel_has_user');
    }
}
