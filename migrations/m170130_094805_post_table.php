<?php

use yii\db\Migration;

class m170130_094805_post_table extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');

        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('id пользователя'),
            'travel_id' => $this->integer()->unsigned()->notNull()->comment('id путешествия'),
            'text' => $this->string(1000)->comment('текст коментария'),
            'last_modified' => $this->timestamp()->comment('время создания/изменения')
        ],
            ' ENGINE = InnoDB COMMENT = \'таблица комментариев\'');

        $this->createIndex('fk_post_user1_idx', 'post', 'user_id');
        $this->createIndex('fk_post_travel_idx', 'post', 'travel_id');

        $this->addForeignKey('fk_post_user1', 'post', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_post_travel1', 'post', 'travel_id', 'travel', 'id', 'NO ACTION', 'NO ACTION');

        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->dropTable('post');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
