<?php

use yii\helpers\Html;

?>
<p class="lead">You have successfully refused the gift</p>
<p class="center-block">
    Go to <?= Html::a('cabinet', ['/site/cabinet']); ?>
<p class="center-block"><?= Html::a('Get a prize!', ['site/raffle'], ['class'=>'btn btn-primary']) ?></p>

</p>