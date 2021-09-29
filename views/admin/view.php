<?php

use yii\widgets\DetailView;

?>
<div>
    <a class="btn btn-success" style="margin-bottom: 20px" href="/admin/index">Назад</a>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id_category',
                'format' => 'raw',
                'value' => function ($item) {
                    $cat = \app\models\Category::find()->where(['id' => $item['id_category']])->one();
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
                'value' => function ($model) {
                    switch ($model['status']){
                        case 0:
                            return "<a href='/admin/success/?id=$model->id'>Принять</a> <a href='/admin/cancel/?id=$model->id'>Отклонить</a>";
                        case 1:
                            return 'Принято';
                        case 2:
                            return 'Отклонено';
                    }
                }
            ],
        ],
    ]); ?>
</div>