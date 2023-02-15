<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offers}}`.
 */
class m221125_121912_create_offers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'CREATE TABLE offers (
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                user_id int NOT NULL,
                title varchar(128) NOT NULL,
                description TEXT NOT NULL,
                category_id int NOT NULL,
                price INT NOT NULL,
                type varchar(10) NOT NULL,
                image varchar(128) NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users (id),
                FOREIGN KEY (category_id) REFERENCES categories (id),
                FULLTEXT(title)
              );'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offers}}');
    }
}
