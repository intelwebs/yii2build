<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_type".
 *
 * @property integer $id
 * @property string $user_type_name
 * @property integer $user_type_value
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_name', 'user_type_value'], 'required'],
            [['user_type_value'], 'integer'],
            [['user_type_name'], 'string', 'max' => 45],

            [['user_type_id'], 'in', 'range' => array_keys($this->getUserTypeList())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type_name' => 'User Type Name',
            'user_type_value' => 'User Type Value',
        ];
    }


    /**
     * getUserType
     */

    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['id' => 'user_type_id']);
    }

    /**
     * get user type name
     */

    public function getUserTypeName()
    {
        return $this->userType ? $this->userType->user_type_name : '- no user type -';
    }

    /**
     * get list of user types for dropdown
     */

    public static function getUserTypeList()
    {
        $droptions = UserType::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'user_type_name');
    }

    /**
     * get user type id
     */

    public function getUserTypeId()
    {
        return $this->userType ? $this->userType->id : 'none';
    }
}
