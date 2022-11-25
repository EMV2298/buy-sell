<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m221125_133536_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'CREATE TABLE comments(
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                user_id int NOT NULL,
                offer_id int NOT NULL,
                message TINYTEXT NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users (id),
                FOREIGN KEY (offer_id) REFERENCES offers (id)ON DELETE CASCADE
            );'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
