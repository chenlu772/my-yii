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
use OAuth2\Response;
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

    public function actionAuthorize(){

        $request = Request::createFromGlobals();
        $response = new Response();
        if(!$this->_server->validateAuthorizeRequest($request, $response)){
            return $response->send();
        }
        if(empty($_POST)){
            return '<form method="post">
                        <label>确认授权登录？</label><br/>
                        <input type="submit" name="authorized" value="yes">
                        <input type="submit" name="authorized" value="no">
                    </form>
                    ';
        }
        $is_authorized = (yii::$app->request->post('authorized') === 'yes');
        $this->_server->handleAuthorizeRequest($request, $response, $is_authorized);
        if($is_authorized){
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);//授权码
            die($code);
        }
        return $response->send();
    }





}