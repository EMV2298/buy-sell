<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offerCategories}}`.
 */
class m221128_164101_create_offerCategories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'CREATE TABLE offerCategories (
                offer_id int NOT NULL,
                category_id int NOT NULL,
                FOREIGN KEY (offer_id) REFERENCES offers (id),
                FOREIGN KEY (category_id) REFERENCES categories (id),
                PRIMARY KEY (offer_id, category_id)
            );'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offerCategories}}');
    }
}
