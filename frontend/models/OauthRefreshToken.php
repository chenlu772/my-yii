<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oauth_refresh_token".
 *
 * @property string $refresh_token
 * @property string $client_id
 * @property string $user_id
 * @property string $expires
 * @property string $scope
 */
class OauthRefreshToken extends \common\models\OauthRefreshToken
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_refresh_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['refresh_token', 'client_id'], 'required'],
            [['expires'], 'safe'],
            [['refresh_token'], 'string', 'max' => 40],
            [['client_id'], 'string', 'max' => 80],
            [['user_id'], 'string', 'max' => 255],
            [['scope'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'refresh_token' => 'Refresh Token',
            'client_id' => 'Client ID',
            'user_id' => 'User ID',
            'expires' => 'Expires',
            'scope' => 'Scope',
        ];
    }
}
