<?php

namespace app\models;

use Yii;


class Cartridge extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'сartridge';
    }
    public function rules()
    {
        return [
            [['count'], 'required'],
            [['count'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'count' => 'Количество картриджей ',
        ];
    }

}
