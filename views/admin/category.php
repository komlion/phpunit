<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return "<a href='/admin/view-category?id=".$model['id']."'><span class='glyphicon glyphicon-eye-open'></span></a>";
                    },
                    'update' => function ($url, $model, $key) {
                        return "<a href='/admin/update-category?id=".$model['id']."'><span class='glyphicon glyphicon-pencil'></span></a>";
                    },
                    'delete' => function ($url, $model, $key) {
                        return "<a href='/admin/delete-category?id=".$model['id']."'><span class='glyphicon glyphicon-trash'></span></a>";
                    }
                ]
            ],
        ],
    ]); ?>


</div>
