<?php

use yii\db\Migration;

/**
 * Class m221125_140424_insert_categories
 */
class m221125_140424_insert_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'INSERT INTO categories (name)
            VALUES ("Дом"), ("Электроника"), ("Одежда"), ("Спорт и отдых"), ("Авто"), ("Книги");'
        );
    }

}
