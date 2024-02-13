<?php

use yii\helpers\Html;

?>
<p class="lead">You have successfully converted coins into loyalty points.</p>
<p class="center-block">
    You have received <strong><?= $points ?></strong> points!<br/>
    Go to <?= Html::a('cabinet', ['/site/cabinet']); ?>
<p class="center-block"><?= Html::a('Get a prize!', ['site/raffle'], ['class'=>'btn btn-primary']) ?></p>

</p>