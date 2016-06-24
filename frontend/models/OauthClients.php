<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oauth_client".
 *
 * @property string $client_id
 * @property string $client_secret
 * @property string $redirect_uri
 */
class OauthClients extends \common\models\OauthClients
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'client_secret', 'redirect_uri'], 'required'],
            [['client_id', 'client_secret'], 'string', 'max' => 80],
            [['redirect_uri'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'client_secret' => 'Client Secret',
            'redirect_uri' => 'Redirect Uri',
        ];
    }
}
