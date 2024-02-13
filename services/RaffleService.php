<?php

use app\models\MoneyPrizeSelection;
use app\models\PointsPrizeSelection;
use app\models\User;

class RaffleService
{
    const TYPE_MONEY = 'money';
    const TYPE_POPINTS = 'points';
    const TYPE_GIFT = 'gift';

    private $user;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws ErrorException
     */
    public function process() {
        $types = [
            static::TYPE_POPINTS,
        ];

        if (PhysicalItemsPrizeSelection::isAvailable()) {
            $types[] = static::TYPE_GIFT;
        }

        if (MoneyPrizeSelection::isAvailable()) {
            $types[] = static::TYPE_MONEY;
        }

        $raffleType = $types[rand(0, 2)];

        switch ($raffleType) {
            default:
                throw new ErrorException('Unknown raffle type');
                break;
            case static::TYPE_GIFT:
                $result = PhysicalItemsPrizeSelection::process($this->user);
                break;
            case static::TYPE_MONEY:
                $result = MoneyPrizeSelection::process($this->user);
                break;
            case static::TYPE_POPINTS:
                $result = PointsPrizeSelection::process($this->user);
                break;
        }

        $result['type'] = $raffleType;
        return $result;
    }
}