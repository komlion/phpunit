<?php
/* @var $this yii\web\View */

use yii\grid\GridView; ?>
<div>
    <h1>Личный кабинет</h1>

    <p>ФИО: <?= Yii::$app->user->identity->fio ?></p>
    <p>Отдел: <?= Yii::$app->user->identity->department ?></p>
    <p>Должность: <?= Yii::$app->user->identity->position ?></p>

    <a class="btn btn-success" href="/products/create">Создать заявку</a>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_category',
                'format' => 'raw',
                'value' => function($item){
                    $cat = \app\models\Category::find()->where(['id'=>$item['id_category']])->one();
                    return $cat->name;
                }
            ],
            'name',
            [
                'attribute' => 'id_user',
                'format' => 'raw',
                'value' => function($item){
                    $cat = \app\models\User::find()->where(['id'=>$item['id_user']])->one();
                    return $cat->fio;
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
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => function ($item) {
                    if ($item['status'] == 0) return '<p>На рассмотрении</p>';
                    if ($item['status'] == 1) return '<p>Принята</p>';
                    if ($item['status'] == 2) return '<p>Отклонена</p>';
                }
            ],
        ],
    ]);?>
</div>
