<?php

use yii\db\Migration;

class m170131_122411_populate_user extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->batchInsert('user', [
            'username',
            'password_hash',
            'email',
            'auth_key',
        ],
            [
                [
                    'admin',
                    Yii::$app->getSecurity()->generatePasswordHash('nimda'),
                    'admin@example.com',
                    Yii::$app->getSecurity()->generateRandomString(),
                ],
                [
                    'user1',
                    Yii::$app->getSecurity()->generatePasswordHash('qwerty123'),
                    'user1@mail.ru',
                    Yii::$app->getSecurity()->generateRandomString(),
                ],
                [
                    'user2',
                    Yii::$app->getSecurity()->generatePasswordHash('qwerty321'),
                    'user2@mail.ru',
                    Yii::$app->getSecurity()->generateRandomString(),
                ],

            ]);
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->delete('user');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
