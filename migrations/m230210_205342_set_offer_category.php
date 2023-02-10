<?php

use yii\db\Migration;

/**
 * Class m230210_205342_set_offer_category
 */
class m230210_205342_set_offer_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'INSERT INTO offerCategories (offer_id, category_id)
            VALUES (1, 1), (1, 2), (2, 2), (3, 2), (4, 1), (4, 4), (5, 1);'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230210_205342_set_offer_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230210_205342_set_offer_category cannot be reverted.\n";

        return false;
    }
    */
}
