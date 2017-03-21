<?php

use yii\db\Migration;

class m170131_131010_populate_transport extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->batchInsert('transport',
            ['name'],
            [
                ['Пешком'],
                ['На велике'],
                ['На авто'],
                ['Поездом'],
                ['Самолетом'],
                ['Пароходом'],
            ]);
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->delete('transport');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
