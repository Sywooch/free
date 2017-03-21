<?php

use yii\db\Migration;

class m170129_192231_image_table extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');

        $this->createTable('image',
            [
                'id' => $this->primaryKey()->unsigned(),
                'path' => $this->string(255)->notNull()->comment('путь к файлу с изображением'),
                'created' => $this->timestamp()->comment('время создания/загрузки'),
                'travel_id' => $this->integer()->unsigned()->comment('ссылка на маршрут'),
                'user_id' => $this->integer()->unsigned()->notNull()->comment('пользователь, выгрузивший картинку'),
            ],
            ' ENGINE = InnoDB COMMENT = \'таблица изобрадений\'');

        $this->createIndex('fk_image_travel1_idx', 'image', 'travel_id');
        $this->createIndex('fk_image_user1_idx', 'image', 'user_id');

        $this->addForeignKey('fk_image_user1', 'image', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_image_travel1', 'image', 'travel_id', 'travel', 'id', 'NO ACTION', 'NO ACTION');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');

    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');

        $this->dropTable('image');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}