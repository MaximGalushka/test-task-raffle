<?php

namespace app\models;


class PointsPrizeSelection implements PrizeSelectionInterface
{
    public static function isAvailable(): bool
    {
        // Всегда возвращаем true, так как баллы всегда доступны
        return true;
    }

    public static function process(User $user): array
    {
        $points = rand(10, 100) * 10;

        
        $userPointsPrize = new UserPoints();
        $userPointsPrize->user_id = $user->id;
        $userPointsPrize->points += $points;
        $userPointsPrize->save();

        return ['balance' => $points];
    }

    public static function addPoints(int $points, User $user) {
        $userPointsPrize = new UserPoints();
        $userPointsPrize->user_id = $user->id;
        $userPointsPrize->points += $points;
        $userPointsPrize->save();

        return ['balance' => $points];
    }
}

