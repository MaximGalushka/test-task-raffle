<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\MoneyPrizeSelection;
use app\models\PhysicalItemPrize;
use app\models\PhysicalItemsPrizeSelection;
use app\models\PointsPrizeSelection;
use app\models\User;
use app\models\UserMoney;
use app\models\UserPhysicalItems;
use app\models\UserPoints;
use Error;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    const TYPE_MONEY = 'money';
    const TYPE_POINTS = 'points';
    const TYPE_GIFT = 'gift';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $command = Yii::$app->db->createCommand('SELECT 1');
        $result = $command->queryScalar();

        if ($result === false) {
            return $this->render('error', [
                'message' => 'Ошибка подключения к базе данных.',
            ]);
        } 
        else {
            return $this->render('index');
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        // $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionRaffle()
    {
        $user = User::findOne(Yii::$app->user->getId());

        return $this->render(
            'raffle',
            [
                'result' => $this->rafleProcess(Yii::$app->user)
            ]
        );
    }

    public function rafleProcess() {
        $user = User::findOne(Yii::$app->user->getId());

        $types = [
            static::TYPE_POINTS,
        ];
        if (PhysicalItemsPrizeSelection::isAvailable()) {

            $types[] = static::TYPE_GIFT;
        }

        if (MoneyPrizeSelection::isAvailable()) {
            $types[] = static::TYPE_MONEY;
        }

        $raffleType = $types[rand(0, sizeof($types) - 1)];
        switch ($raffleType) {
            default:
                throw new Error('Unknown raffle type');
                break;
            case static::TYPE_GIFT:
                $result = PhysicalItemsPrizeSelection::process($user);

                break;
            case static::TYPE_MONEY:
                $result = MoneyPrizeSelection::process($user);
                print_r($result);

                break;
            case static::TYPE_POINTS:
                $result = PointsPrizeSelection::process($user);

                break;
        }

        $result['type'] = $raffleType;
        return $result;
    }

    public function actionCabinet()
    {
        $user = Yii::$app->user;
        $userPoints = UserPoints::find()->where(['user_id' => $user->id])->sum('points');
        $userBalance = UserMoney::find()->where(['user_id' => $user->id])->sum('amount');
        $userGifts = UserPhysicalItems::find()->where(['user_id' => $user->id])->all();
        return $this->render('cabinet',
            [
                'user' => $user,
                'userPoints' => $userPoints,
                'userBalance' => $userBalance,
                'userGifts' => $userGifts,
                'convertFactor' => 10,
            ]);
    }


    public function actionConvert()
    {
        $user = User::findOne(Yii::$app->user->getId());
        $coefficient = 10;
        $lastTransaction = UserMoney::find()
            ->where(['user_id' => $user->id])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        $convertedPoints = $lastTransaction->amount * $coefficient;

        MoneyPrizeSelection::convertMoneyToPoints($user, $convertedPoints);
        $lastTransaction->delete();

        return $this->render('points/convert', ['points' => $convertedPoints]);
    }

    public function actionApprove()
    {
        return $this->render('points/approve');
    }

    public function actionRefuse()
    {
        $user = User::findOne(Yii::$app->user->getId());
        $lastGift = UserPhysicalItems::find()
            ->where(['user_id' => $user->id])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        $lastGift->delete();
        $currentGiftName = $lastGift->item_name;
        $giftsWithCurrentName = PhysicalItemPrize::getPrizeByName($currentGiftName);
        $giftsWithCurrentName->in_stock++;
        $giftsWithCurrentName->save();
        return $this->render('gift/refuse');
    }
}
