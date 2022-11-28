<?php

use yii\db\Migration;

/**
 * Class m221128_164913_drop_category_id_from_offers
 */
class m221128_164913_drop_category_id_from_offers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('offers_ibfk_2', 'offers');
        $this->dropColumn('offers', 'category_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221128_164913_drop_category_id_from_offers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221128_164913_drop_category_id_from_offers cannot be reverted.\n";

        return false;
    }
    */
}
