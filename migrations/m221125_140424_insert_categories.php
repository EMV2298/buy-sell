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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221125_140424_insert_categories cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221125_140424_insert_categories cannot be reverted.\n";

        return false;
    }
    */
}
