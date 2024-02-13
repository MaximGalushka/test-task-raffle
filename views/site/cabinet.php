<?php

?>
<p class="lead">Hello, <strong><?= $user->identity->username ?></strong></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p class="lead">Gifts</p>
            <ul>
                <?php foreach ($userGifts as $gift): ?>
                    <?php
                    $deliveryStatusText = '';
                    switch ($gift->delivery_status) {
                        case 0:
                            $deliveryStatusText = 'WAIT';
                            break;
                        case 1:
                            $deliveryStatusText = 'PROCESS';
                            break;
                        case 2:
                            $deliveryStatusText = 'DELIVERED';
                            break;
                        default:
                            $deliveryStatusText = 'UNKNOWN STATUS';
                            break;
                    }
                    ?>
                    <li><?= $gift->item_name ?> (Delivery status: <?= $deliveryStatusText ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-4">
             <p class="lead">Money (Balance: <?= $userBalance ?>)</p>

        </div>
        <div class="col-md-4">
            <p class="lead">Points (Balance: <?= $userPoints ?>)</p>
        </div>
    </div>
</div>