<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Raffle';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-rafle">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="lead">The draw was successfully completed</p>
    <?=$this->render('raffle_type/'.$result['type'], ['result'=>$result])?>
    <?php if ($result['type'] != 'money'): ?>
        <p class="center-block"><?= Html::a('Get a prize!', ['site/raffle'], ['class'=>'btn btn-primary']) ?></p>
    <?php endif; ?>
</div>