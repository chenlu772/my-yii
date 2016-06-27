<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2016/6/23
 * Time: 14:56
 */

namespace frontend\controllers;

use frontend\models\OauthClients;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\ImplicitTest;
use OAuth2\GrantType\JwtBearer;
use OAuth2\GrantType\UserCredentials;
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
        $server->addGrantType(new ClientCredentials($storage));//客户端模式
        $server->addGrantType(new AuthorizationCode($storage));//授权码模式
        $server->addGrantType(new UserCredentials($storage));//密码模式
        $this->_server = $server;

        return true;
    }

    //获取access_token
    public function actionToken(){
        $this->_server->handleTokenRequest(Request::createFromGlobals())->send();
    }

    //校验access_token是否合法
    public function actionResource(){
        if(!$this->_server->verifyResourceRequest(Request::createFromGlobals())){
            return $this->_server->getResponse()->send();
        }

        return json_encode(array('success'=>true, 'message'=>'access'));
    }

    /*
     * 获取授权码
     * */
    public function actionAuthorize(){

        $request = Request::createFromGlobals();
        $response = new Response();
        if(!$this->_server->validateAuthorizeRequest($request, $response)){
            return $response->send();
        }
        $o_user_id = yii::$app->session->get('o_user_id');
        if(!yii::$app->request->isPost){
            if(!empty($o_user_id)){
                return $this->renderPartial('../auth-login/authorization');
            }
            else{
                return $this->redirect(['auth-login/index']);
            }
        }
        $is_authorized = (yii::$app->request->post('authorized') === 'yes');
        $this->_server->handleAuthorizeRequest($request, $response, $is_authorized, $o_user_id);
        if($is_authorized){
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);//授权码
            $arr = yii\helpers\ArrayHelper::toArray($request);
            $client_id = $arr['query']['client_id'];
            $clientInfo = OauthClients::findOne($client_id);

            return $this->redirect($clientInfo['redirect_uri'].'?code='.$code);
        }
        return $response->send();
    }





}