<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($item){
                    return '<p style="width: 200px">'.$item['title'].'</p>';
                }
            ],
            [
                'attribute' => 'Text',
                'format' => 'raw',
                'value' => function($item){
                    return '<p style="width: 500px">'.$item['text'].'</p>';
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($item){
                    return  "<img width='100' src='../web/uploads/".$item['image']."'>";
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
