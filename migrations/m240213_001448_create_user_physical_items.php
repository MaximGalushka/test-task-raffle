<?php

use yii\db\Migration;

/**
 * Class m240213_001448_create_user_physical_items
 */
class m240213_001448_create_user_physical_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%user_physical_items}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'item_name' => $this->string()->notNull(),
            'delivery_status' => $this->integer()->defaultValue(0), // 0 for not delivered, 1 for delivered
        ]);

        // Добавляем внешний ключ
        $this->addForeignKey(
            'fk-user_physical_items-user_id',
            '{{%user_physical_items}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240213_001448_create_user_physical_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240213_001448_create_user_physical_items cannot be reverted.\n";

        return false;
    }
    */
}
