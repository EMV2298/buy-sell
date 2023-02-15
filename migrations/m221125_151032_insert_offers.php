<?php

use yii\db\Migration;

/**
 * Class m221125_151032_insert_offers
 */
class m221125_151032_insert_offers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'INSERT INTO offers (user_id, title, description, category_id, price, type, image)
            VALUES ("1", "Телефон домашний", "продаю домашний беспроводной телефон. Умер аккумулятор.", "2", "500", "sell", "file1.jpg"),
            ("1", "Ультрабук на i5", "Продам ультрабук Toshiba тёмно-синего цвета, тонкий и лёгкий (1,7кг)", "2", "10000", "sell", "file2.jpg"), 
            ("2", "Apple MacBook Air", "Состояние идеальное, в комплекте мак и зарядка, ничего не ремонтировалось.", "2", "23000", "sell", "file3.jpg"),
            ("2", "Подвесное кресло кокон", "Кресло кокон DeckWOOD ( уценённый товар) в наличии осталось одно кресло.", "1", "17000", "sell", "file4.jpg"),
            ("2", "Кофеварка", "Куплю вот такую итальянскую кофеварку, можно любой", "1", "2000", "buy", "file5.jpg");'
        );
    }

}
