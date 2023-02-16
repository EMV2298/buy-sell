<?php

use yii\db\Migration;

/**
 * Class m221125_145945_insert_users
 */
class m221125_145945_insert_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'INSERT INTO users (username, email, avatar)
            VALUES ("Марина Штольц", "marina@mail.ru", "avatar1.jpg"),
            ("Владислав Крапивин", "vlad@mail.ru", "avatar2.jpg"), 
            ("Антон Фен", "anton@mail.ru", "avatar3.jpg"),
            ("Екатерина Павлова", "katya@mail.ru", "avatar4.jpg"),
            ("Мария Хан", "mary@mail.ru", "avatar5.jpeg");'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221125_145945_insert_users cannot be reverted.\n";

        return false;
    }
}
