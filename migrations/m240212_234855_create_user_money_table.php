<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_money}}`.
 */
class m240212_234855_create_user_money_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_money}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'amount' => $this->integer()->defaultValue(0),
            'transfer_status' => $this->tinyInteger()->notNull()->defaultValue(0), // Добавляем поле статуса трансфера
        ]);

        $this->batchInsert('{{%user_money}}', ['user_id', 'amount', 'transfer_status'], [
            [1, 80, 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_money}}');
    }
}
