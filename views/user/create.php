<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Добавление полоьзователя';
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="form-registration">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
