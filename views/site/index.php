<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <?php foreach ($model as $item):?>
        <div class="col-5">
            <div class="thumbnail">
                <img width="200" src="../web/uploads/<?= $item['image'] ?>" alt="...">
                <div class="caption">
                    <h3><?= $item['title'] ?></h3>
                    <p><?= $item['text'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
</div>
