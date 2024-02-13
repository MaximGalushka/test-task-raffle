<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%physical_item_prizes}}`.
 */
class m240212_234813_create_physical_item_prizes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%physical_item_prizes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'in_stock' => $this->integer()->notNull(),
        ]);

        // Добавляем данные в таблицу
        $this->batchInsert('{{%physical_item_prizes}}', ['name', 'in_stock'], [
            ['iPhone 13', 100],
            ['PlayStation 5', 50],
            ['GoPro Hero 10', 200],
            ['AirPods Pro', 75],
            ['Kindle Paperwhite', 150],
            ['Samsung Galaxy Watch 4', 100],
            ['Nintendo Switch OLED', 50],
            ['DJI Mavic Air 2', 200],
            ['Fitbit Charge 5', 75],
            ['Bose QuietComfort 45', 150],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%physical_item_prizes}}');
    }
}
