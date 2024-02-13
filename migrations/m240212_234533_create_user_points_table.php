<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_points}}`.
 */
class m240212_234533_create_user_points_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_points}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'points' => $this->integer()->defaultValue(0),
        ]);

        // Добавляем данные с помощью batchInsert()
        $this->batchInsert('{{%user_points}}', ['user_id', 'points'], [
            [1, 100], // Пользователь с id = 1 имеет 100 баллов
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_points}}');
    }
}
