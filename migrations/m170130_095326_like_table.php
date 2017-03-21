<?php

use yii\db\Migration;

class m170130_095326_like_table extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');

        $this->createTable('like', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('ссылка на пользователь'),
            'created' => $this->timestamp()->comment('время создания'),
            'travel_id' => $this->integer()->unsigned()->notNull()->comment('id путешествия')
        ],
            ' ENGINE = InnoDB COMMENT = \'таблица лайков\'');

        $this->createIndex('fk_like_travel1_idx', 'like', 'travel_id');
        $this->createIndex('fk_like_user1_idx', 'like', 'user_id');

        $this->addForeignKey('fk_like_travel1', 'like', 'travel_id', 'travel', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_like_user1', 'like', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->dropTable('like');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
