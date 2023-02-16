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
}
