<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password2;

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['email', 'password', 'fio','password2','department', 'position','age','role'], 'required'],
            ['age','integer'],
            ['fio', 'match', 'pattern' => '~^(\p{L}|\p{Zs})+$~u', 'message' => 'Поле "ФИО" может содержать только буквы'],
            ['password2', 'validatePass'],
            ['email', 'validateEmail'],
            ['email', 'email']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_user' => 'ФИО',
            'id' => 'ID',
            'email' => 'Email',
            'fio' => 'ФИО',
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
            'department' => 'Отдел',
            'position' => 'Должность',
            'age' => 'Возраст',
            'role' => 'Роль',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id_user' => 'id']);
    }

    public static function findByUsername($username)
    {
        return self::find()->where(['email' => $username])->one();
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function validatePass($attr, $params)
    {
        if ($this->password2 != $this->password) {
            return $this->addError($attr, 'Пароли не совпадают');
        }
    }

    public function validateEmail($attr, $params)
    {
        $user = self::find()->where(['email' => $this->email])->one();

        if ($user != null) {
            return $this->addError($attr, 'Email занят');
        }
    }

    public function isAdmin()
    {
        return $this->role === 1;
    }
}
