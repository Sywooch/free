<?php

use yii\db\Migration;

class m170130_075006_user_table extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');

        $this->createTable('user', [
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string(45)->notNull()->unique()->comment('логин'),
            'password_hash' => $this->string(255)->notNull()->comment('хеш пароля'),
            'email' => $this->string(45)->notNull()->unique(),
            'reset_token' => $this->string(255)->unique()->comment('токен для сброса пароля'),
            'last_modified' => $this->timestamp()->comment('время последнего изменения'),
            'birth_date' => $this->date()->comment('дата рождения'),
            'about' => $this->string(1000)->comment('о себе (хобби и т.д)'),
            'city' => $this->string(45)->comment('город участника'),
            'name' => $this->string(45)->comment('имя'),
            'surname' => $this->string(45)->comment('фамилия'),
            'image_id' => $this->integer()->unsigned()->comment('ссылка на аватар'),
            'auth_key' => $this->string(32)->unique()->comment('ключ авторизации (для REST)')
        ],
            ' ENGINE = InnoDB COMMENT = \'таблица пользователей\'');

        $this->createIndex('fk_user_image1_idx', 'user', 'image_id');
        $this->addForeignKey('fk_user_image1', 'user', 'image_id', 'image', 'id', 'NO ACTION', 'NO ACTION');

        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->dropTable('user');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
