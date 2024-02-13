<?php
namespace app\models;

use yii\db\Exception;


class PhysicalItemsPrizeSelection implements PrizeSelectionInterface
{
    public static function isAvailable(): bool
    {
        // Проверяем наличие физических предметов в базе данных
        return PhysicalItemPrize::find()->where(['>', 'in_stock', 0])->count() > 0;
    }

    public static function process(User $user): array
    {
        // Получаем доступные физические предметы
        $availableItems = PhysicalItemPrize::find()->where(['>', 'in_stock', 0])->all();

        // Если нет доступных предметов, выбрасываем исключение
        if (empty($availableItems)) {
            throw new Exception('No available physical items found.');
        }

        // Выбираем случайный предмет
        $randomItem = $availableItems[array_rand($availableItems)];

        // Создаем запись о предмете для пользователя
        $userPhysicalItem = new UserPhysicalItems();
        $userPhysicalItem->user_id = $user->id;
        $userPhysicalItem->item_name = $randomItem->name;
        $userPhysicalItem->delivery_status = 0;
        $userPhysicalItem->save();

        // Декрементируем значение in_stock и сохраняем обновленную запись
        $randomItem->in_stock--;
        $randomItem->save();

        return ['physical_item' => $randomItem];
    }
}