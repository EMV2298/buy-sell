<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m221125_115912_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                vk_id varchar(128) NULL,
                dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                username varchar(128) NOT NULL,
                email varchar(128) UNIQUE NOT NULL,
                password varchar(128) NULL,
                avatar varchar(128) NOT NULL,
                admin BOOLEAN NULL
              );'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
