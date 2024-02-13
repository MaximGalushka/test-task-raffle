<?php
namespace app\models;

interface PrizeSelectionInterface
{
    public static function isAvailable(): bool;

    public static function process(User $user): array;
}

