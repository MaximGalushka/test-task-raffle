<?php

namespace app\commands;

use app\models\UserGifts;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class SendGiftsPrizesController extends Controller
{
    public function actionIndex($sentGiftId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $gift = UserGifts::findOne($sentGiftId);
            $gift->delivery_status = UserGifts::DELIVERY_STATUS_PROCESS;
            $gift->save();

            $transaction->commit();
            echo "The gift has been sent\n";
            return ExitCode::OK;
        } catch (\Exception $e) {
            $transaction->rollBack();
            echo "Error: {$e->getMessage()}\n";
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}