<?php

namespace app\models;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;
use Yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $user_id
 * @property string $description
 * @property string $file
 * @property Users $user
 */
class Tasks extends \yii\db\ActiveRecord
{

    /** @var UploadedFile */
    public $BinFile;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date', 'user_id'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['file'], 'file', 'extensions' => 'jpg, bmp'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t("msg", "ID"),
            'name' => \Yii::t("msg", 'Name'),
            'date' => \Yii::t("msg", 'Date'),
            'user_id' => \Yii::t("msg", 'UserID'),
            'description' => \Yii::t("msg", 'Description'),
            'file' => \Yii::t("msg", 'File'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }


    public function saveUploadedFile($FileName){

        $path = yii::getAlias('@webroot/img/');
        $fullName = $path . $FileName;
        $this->file->saveAs($fullName);
        Image::thumbnail($fullName, 100, 100)->save($path."small/".$FileName);

    }
}
