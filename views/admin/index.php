<?php
/* @var $this yii\web\View */

use yii\grid\GridView; ?>
<div>
    <h1>Панель администратора</h1>
    <h3>Картриджей осталось: <b><?= $count['count']?></h3>
    <a class="btn btn-success" href="/admin/category">Категории</a>
    <a class="btn btn-success" href="/news/index">Новости</a>
    <a class="btn btn-success" href="/user/index">Пользователи</a>
    <a class="btn btn-success" href="/admin/cartri">Картриджи</a>

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
            [
                'format' => 'raw',
                'value' => function ($item) {
                    return "<a href='/admin/view?id=".$item['id']."'>Просмотреть</a>";
                },
            ]
        ],
    ]);?>
</div>
