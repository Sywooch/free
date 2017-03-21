<?php

use yii\db\Migration;

class m170130_094049_travel_table extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');

        $this->createTable('travel', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(45)->notNull()->comment('название маршрута'),
            'desc' => $this->string(2000)->comment('описание маршрута'),
            'start_point' => $this->string(100)->notNull()->comment('начальная точка'),
            'end_point' => $this->string(100)->notNull()->comment('конечная точка'),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('владеелец(инициатор) маршрута, ссылка на запись в user'),
            'beg_date' => $this->timestamp()->null()->comment('дата начала путешествия'),
            'end_date' => $this->timestamp()->null()->comment('продолжительность путешествия'),
            'transport_id' => $this->integer()->unsigned()->notNull()->comment('ссылка на вид транспорта'),
            'status' => $this->integer()->notNull()->defaultValue(0)->comment('статус:\n0 - новый\n1 - в пути\n2 - завершившийся')
        ],
            ' ENGINE = InnoDB COMMENT = \'таблица путешествий\'');

        $this->createIndex('fk_travel_transport1_idx', 'travel', 'transport_id');
        $this->createIndex('fk_travel_user1_idx', 'travel', 'user_id');

        $this->addForeignKey('fk_travel_transport1', 'travel', 'transport_id', 'transport', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_travel_user1', 'travel', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->dropTable('travel');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
