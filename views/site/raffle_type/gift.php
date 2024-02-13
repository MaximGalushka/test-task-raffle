<?php

use yii\helpers\Html;

?>

<p>You received
    <strong>a gift of 1</strong>
    <mark><?= $result["physical_item"]->name ?><mark>
    <p>
        <?= Html::a(
            'Click to refuse a gift',
            ['refuse'],
            ['class' => 'text-danger']
        ) ?>
    </p>
</p>
