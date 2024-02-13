<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\Nav;

$this->title = 'test-task';

?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <div class="jumbotron">
        <h1>Raffle prizes!</h1>
        <p class="lead">There is a chance to win any item, money or loyalty points</p>
        <?php if(Yii::$app->user->isGuest):?>
            <p>Just <?php echo Html::a('login', ['/site/login']);?> or log in for the giveaway</p>
        <?php else:?>
            <p>Hello, <strong><?=Yii::$app->user->identity->username?></strong>, all you have to do is press the button</p>
            <p class="center-block"><?=Html::a('Get a prize!', ['site/raffle'], ['class'=>'btn btn-primary']);?></p>
        <?php endif;?>
    </div>
</div>