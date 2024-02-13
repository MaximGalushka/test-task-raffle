<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240213_001418_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'balance' => $this->decimal(10, 2)->defaultValue(0.00),
            'user_money_id' => $this->integer(),
            'user_points_id' => $this->integer(),
        ]);

        // Добавляем внешние ключи
        $this->addForeignKey(
            'fk-users-user_money_id',
            '{{%users}}',
            'user_money_id',
            '{{%user_money}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-users-user_points_id',
            '{{%users}}',
            'user_points_id',
            '{{%user_points}}',
            'id',
            'CASCADE'
        );

        $this->insert('users', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('password123'),
            'user_money_id' => 1,
            'user_points_id' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
