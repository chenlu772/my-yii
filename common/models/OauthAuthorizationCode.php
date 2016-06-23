<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oauth_authorization_code".
 *
 * @property string $authorization_code
 * @property string $client_id
 * @property string $user_id
 * @property string $redirect_uri
 * @property string $expires
 * @property string $scope
 */
class OauthAuthorizationCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_authorization_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authorization_code', 'client_id'], 'required'],
            [['expires'], 'safe'],
            [['authorization_code'], 'string', 'max' => 40],
            [['client_id'], 'string', 'max' => 80],
            [['user_id'], 'string', 'max' => 255],
            [['redirect_uri', 'scope'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'authorization_code' => 'Authorization Code',
            'client_id' => 'Client ID',
            'user_id' => 'User ID',
            'redirect_uri' => 'Redirect Uri',
            'expires' => 'Expires',
            'scope' => 'Scope',
        ];
    }
}
