<?php

use yii\db\Migration;
use app\models\UserRepository;
use app\models\Travel;

class m170131_162137_populate_like extends Migration
{
    public function safeUp()
    {
        $users = UserRepository::find()->orderBy('id')->all();
        $travels = Travel::find()->orderBy('id')->all();

        $this->batchInsert('like',
            [
                'user_id',
                'travel_id',
            ],
            [
                [
                    $users[0]->id,
                    $travels[1]->id,
                ],
                [
                    $users[2]->id,
                    $travels[1]->id,
                ],
                [
                    $users[1]->id,
                    $travels[0]->id,
                ],
                [
                    $users[2]->id,
                    $travels[0]->id,
                ],
                [
                    $users[0]->id,
                    $travels[2]->id,
                ],
                [
                    $users[1]->id,
                    $travels[2]->id,
                ],
                [
                    $users[2]->id,
                    $travels[2]->id,
                ],

            ]);
    }

    public function safeDown()
    {
        $this->delete('like');
    }
}
