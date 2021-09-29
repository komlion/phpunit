<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'text:ntext',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($item){
                    return  "<img width='400' src='../web/uploads/".$item['image']."'>";
                }
            ],
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function($item){
                    $date = explode(' ',$item['date']);
                    $d = explode('-',$date[0]);
                    return $d[2].'-'.$d[1].'-'.$d[0];
                }
            ],
        ],
    ]) ?>

</div>
