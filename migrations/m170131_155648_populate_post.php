<?php

use yii\db\Migration;
use app\models\Travel;
use app\models\UserRepository;

class m170131_155648_populate_post extends Migration
{
    public function safeUp()
    {
        $travels = Travel::find()->orderBy('id')->all();
        $users = UserRepository::find()->orderBy('id')->all();

        $this->batchInsert('post',
            [
                'user_id',
                'travel_id',
                'text',
            ],
            [
                [
                    $users[0]->id,
                    $travels[0]->id,
                    'Ищу попутчиков, кто со мной?',
                ],
                [
                    $users[1]->id,
                    $travels[0]->id,
                    'Поехали!!!',
                ],
                [
                    $users[2]->id,
                    $travels[0]->id,
                    'Мужики, хочу быть третьим)',
                ],
            ]);
    }

    public function safeDown()
    {
        $this->delete('post');
    }
}
