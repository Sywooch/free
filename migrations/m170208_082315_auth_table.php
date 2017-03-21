<?php

use yii\db\Migration;

class m170208_082315_auth_table extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned()->notNull()->comment('reference to user table'),
            'source' => $this->string()->notNull()->comment('external source ID'),
            'source_id' => $this->string()->notNull()->comment('user ID in external source'),
        ]);
        $this->addCommentOnTable('auth', 'user credentials on external resources');
        $this->addForeignKey('fk_auth_user1', 'auth', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');

    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->dropTable('auth');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }

}
