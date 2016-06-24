<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2016/6/24
 * Time: 11:37
 */
namespace frontend\controllers;

use frontend\models\Ouser;
use yii;
use yii\web\Controller;

class AuthLoginController extends Controller{

    public function actionIndex(){
        $client_id = yii::$app->request->get('client_id');
        $response_type = yii::$app->request->get('response_type');
        $state = yii::$app->request->get('state');
        $data = array(
            'client_id' => $client_id,
            'response_type' => $response_type,
            'state' => $state
        );
//        var_dump($data);die;
        $model = new Ouser();
        return $this->render('index',[
            'model'=> $model,
            'data' => $data
        ]);
    }



}