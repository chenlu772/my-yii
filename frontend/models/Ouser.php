<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ouser".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 */
class Ouser extends \common\models\Ouser
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ouser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
