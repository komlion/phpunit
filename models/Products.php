<?php

namespace app\models;

use Yii;

class Products extends \yii\db\ActiveRecord
{
    public $imageFile;
    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['id_category', 'name',], 'required'],
            [['id_user', 'id_category','status'], 'integer'],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_category' => 'Категория',
            'id_user' => 'ФИО',
            'name' => 'Отдел',
            'date' => 'Дата',
            'status' => 'Статус'
        ];
    }

//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//            $this->id_user = Yii::$app->user->identity->id;
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

//    public function cancel()
//    {
//
//    }

}
