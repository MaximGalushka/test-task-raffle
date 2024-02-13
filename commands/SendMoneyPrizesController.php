<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\UserMoney;
use yii\console\ExitCode;

class SendMoneyPrizesController extends Controller
{
    public function actionIndex($batchSize = 10)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Находим денежные призы, которые еще не были отправлены
            $moneyPrizes = UserMoney::find()->where(['transfer_status' => UserMoney::IN_PROCESS])->limit($batchSize)->all();

            // Отправляем денежные призы
            foreach ($moneyPrizes as $moneyPrize) {
                // Логика отправки денежного приза
                $moneyPrize->transfer_status = UserMoney::TRANSFERRED;
                $moneyPrize->save();
                // Отправка денежного приза...
            }

            $transaction->commit();
            echo "Sent money prizes to {$batchSize} users.\n";
            return ExitCode::OK;
        } catch (\Exception $e) {
            $transaction->rollBack();
            echo "Error: {$e->getMessage()}\n";
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}
