<?php

?>
<p class="lead">Hello, <strong><?= $user->identity->username ?></strong></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p class="lead"><b>Gifts</b></p>
            <ul>
                <p class="lead">Gifts history:</p>
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
                    <li class="d-flex justify-content-between"><mark><b><?= $gift->item_name ?></b></mark> (Delivery status: <?= $deliveryStatusText ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-4">
             <p class="lead"><b>Money (Balance: <?= $userBalance ?>)</b></p>
             <p class="lead">Money prizes history</p>
            <?php foreach ($allUsersMoneyPrizes as $moneyPrize): ?>
            <?php
            $transactionStatus = '';
            switch ($moneyPrize->transfer_status) {
                case 0:
                    $transactionStatus = 'In_process';
                    break;
                case 1:
                    $transactionStatus = 'Transferred';
                    break;
                default:
                    $transactionStatus = 'UNKNOWN STATUS';
                    break;
            }
            ?>
                <li class="d-flex justify-content-between"><mark><b>Money prize: <?= $moneyPrize->amount ?></b></mark><span>(Transaction status: <?= $transactionStatus ?>)</span></li>
            <?php endforeach; ?>
        </div>
        <div class="col-md-4">
            <p class="lead"><b>Points (Balance: <?= $userPoints ?>)</b></p>
        </div>
    </div>
</div>