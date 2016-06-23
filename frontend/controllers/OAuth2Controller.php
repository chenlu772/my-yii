<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2016/6/23
 * Time: 14:56
 */

namespace frontend\controllers;

use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\Request;
use OAuth2\Server;
use OAuth2\Storage\Pdo;
use yii;
use yii\web\Controller;

class OAuth2Controller extends Controller{

    protected $_server;
    public $enableCsrfValidation = false;

    public function beforeAction($action){
        if(!parent::beforeAction($action)) return false;

        $storage = new Pdo(Yii::$app->params['db_param']);
        $server = new Server($storage, array('enforce_state'=>false));
        $server->addGrantType(new ClientCredentials($storage));
        $server->addGrantType(new AuthorizationCode($storage));
        $this->_server = $server;

        return true;
    }

    public function actionToken(){
        $this->_server->handleTokenRequest(Request::createFromGlobals())->send();
    }

    public function actionResource(){
        if(!$this->_server->verifyResourceRequest(Request::createFromGlobals())){
            return $this->_server->getResponse()->send();
        }

        return json_encode(array('success'=>true, 'message'=>'access'));
    }






}