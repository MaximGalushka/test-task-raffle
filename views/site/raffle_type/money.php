<?php

use yii\helpers\Html;
?>

<p>You received a
    <strong>cash prize</strong> of
    <mark><?= $result['money'] ?> coins</mark>
</p>
<p>You can
    <?= Html::a(
        'accept',
        ['approve'],
        ['class' => 'btn btn-success']
    ) ?>
    cash or
    <?= Html::a(
        'convert to points',
        ['convert'],
        ['class' => 'btn btn-success']
    ) ?>
</p>