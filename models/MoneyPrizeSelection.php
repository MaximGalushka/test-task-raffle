<?php

namespace app\models;

use Exception;
use Yii;


class MoneyPrizeSelection implements PrizeSelectionInterface
{
    public static function isAvailable(): bool
    {
        // Проверяем наличие денежных призов в базе данных
        return true;
    }

    public static function process(User $user): array
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $money = rand(10, 100);

            // Сохраняем информацию о призе для пользователя
            $userMoneyPrize = new UserMoney();
            $userMoneyPrize->user_id = $user->id;
            $userMoneyPrize->amount += $money;
            $userMoneyPrize->transfer_status = 0;
            $userMoneyPrize->save();

            $transaction->commit();

            return ['money' => $money];
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::error('Error processing money prize: ' . $e->getMessage());
            return [];
        }
    }

    public static function convertMoneyToPoints(User $user, int $amount)
    {
            PointsPrizeSelection::addPoints($amount, $user);
            return true;
    }

}