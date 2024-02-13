<?php

use yii\helpers\Html;

?>
<p class="lead">Congratulations! We will send your money to your bank account</p>
<p class="center-block">
    You can familiarize yourself with the process in your <?= Html::a('cabinet', ['/site/cabinet']); ?>
<p class="center-block"><?= Html::a('Get a prize!', ['site/raffle'], ['class'=>'btn btn-primary']) ?></p>

</p>