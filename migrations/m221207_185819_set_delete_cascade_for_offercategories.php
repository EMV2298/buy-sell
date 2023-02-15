<?php

use yii\db\Migration;

/**
 * Class m221207_185819_set_delete_cascade_for_offercategories
 */
class m221207_185819_set_delete_cascade_for_offercategories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            'ALTER TABLE `offerCategories` 
            DROP FOREIGN KEY `offercategories_ibfk_1`; 
            ALTER TABLE `offerCategories` 
            ADD CONSTRAINT `offercategories_ibfk_1` 
            FOREIGN KEY (`offer_id`) REFERENCES `offers`(`id`) 
            ON DELETE CASCADE ON UPDATE RESTRICT;'
        );
    }

}
