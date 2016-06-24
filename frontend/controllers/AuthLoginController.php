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
        $model = new Ouser();
        if(yii::$app->request->isPost ){

            $username = Yii::$app->request->post('Ouser')['username'];
            $password = Yii::$app->request->post('Ouser')['password'];
            $rememberMe = yii::$app->request->post('Ouser')['rememberMe'];

            $data = $model->findOne(array('username'=>$username));
            if( !empty($data) && md5($password) == $data['password']){
                $data['rememberMe'] = $rememberMe;
                $data->save();
                yii::$app->session->set('o_user_id', $data['user_id']);
                return $this->renderPartial('authorization');
            }
            else{
                return $this->renderPartial('index',[
                    'model'  => $model,
                    'tips'  => true,
                ]);
            }

        }
        return $this->renderPartial('index',[
            'model'  => $model,
            'tips'  => false,
        ]);

//        var_dump($data);die;
    }



}