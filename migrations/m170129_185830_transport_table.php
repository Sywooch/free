<?php

use yii\db\Migration;

class m170129_185830_transport_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('transport',
            [
                'id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(45)->notNull()->comment('название транспорта'),
            ],
            ' ENGINE = InnoDB COMMENT = \'таблица видов транспорта\''
        );
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->dropTable('transport');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
