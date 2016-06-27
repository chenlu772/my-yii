<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oauth_users".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 */
class OauthUsers extends \common\models\OauthUsers
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_users';
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
            'username' => '用户名',
            'password' => '密 码',
            'rememberMe' => '记住我',
        ];
    }
}
