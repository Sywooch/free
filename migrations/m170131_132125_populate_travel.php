<?php

use yii\db\Migration;
use app\models\UserRepository;
use app\models\Transport;

class m170131_132125_populate_travel extends Migration
{
    public function safeUp()
    {
        $users = UserRepository::find()->orderBy('id')->all();
        $transports = Transport::find()->orderBy('id')->all();

        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->batchInsert('travel',
            [
                'title',
                'desc',
                'start_point',
                'end_point',
                'user_id',
                'beg_date',
                'end_date',
                'transport_id',
            ],
            [
                [
                    'На великах на море!',
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A cumque dignissimos ea iure molestias quos, sed! Animi beatae distinctio dolore dolorum id optio quam! Assumenda illo molestiae necessitatibus nostrum qui.',
                    'Калининград, пл. Победы',
                    'Светлогорск',
                    $users[0]->id,  //admin
                    date('Y-m-d H:i:s', strtotime("2017-1-2 12:10:30")),
                    date('Y-m-d H:i:s', strtotime("2017-1-2 12:10:30")),
                    $transports[1]->id, // на велике
                ],
                [
                    'Из москвы в культурную столицу',
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A cumque dignissimos ea iure molestias quos, sed! Animi beatae distinctio dolore dolorum id optio quam! Assumenda illo molestiae necessitatibus nostrum qui.',
                    'Москва',
                    'С.-Петербург',
                    $users[1]->id,  //user1
                    date('Y-m-d H:i:s', strtotime("2017-1-2 12:10:30")),
                    date('Y-m-d H:i:s', strtotime("2017-1-2 12:10:30")),
                    $transports[3]->id, // поездом
                ],
                [
                    'Увидеть Париж и умереть',
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A cumque dignissimos ea iure molestias quos, sed! Animi beatae distinctio dolore dolorum id optio quam! Assumenda illo molestiae necessitatibus nostrum qui.',
                    'Москва',
                    'Paris, France',
                    $users[2]->id,  //user2
                    date('Y-m-d H:i:s', strtotime("2017-1-2 12:10:30")),
                    date('Y-m-d H:i:s', strtotime("2017-1-2 12:10:30")),
                    $transports[4]->id, // самолетом
                ],
            ]);
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->delete('travel');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

}
