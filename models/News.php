<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'image'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpeg, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'imageFile' => 'Фото',
            'date' => 'Дата',
            'image'=>'Фото'
        ];
    }

    public function upload()
    {
        $this->image = $this->imageFile->baseName . '.' . $this->imageFile->extension;
        if ($this->validate()) {
            foreach ($this->imageFile as $file) {
                $this->imageFile->saveAs('web/uploads/' . $this->image);
            }
            return true;
        } else {
            return false;
        }
    }
}
