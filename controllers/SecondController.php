<?php
/**
 * Created by PhpStorm.
 * User: gfc-c
 * Date: 09.04.2018
 * Time: 12:25
 */

namespace app\controllers;


use app\models\Users;
use yii\db\Query;
use yii\web\Controller;

class SecondController extends Controller
{

    public function actionIndex(){

        $users = Users::find()->all();
        return $this->render("index", ['users' => $users]);

    }

    public function actionUserdelete(){

        $model = Users::deleteAll('id='.$_GET['id']);

        return "";
    }

    public function actionUseradd(){

        $model = new Users();
        $model->login = $_GET['login'];
        $model->password = md5($_GET['password']);
        $model->save();

        return "";
    }


    public function actionPasswordchange(){

        $model = Users::findOne($_GET['id']);
        $model->password = md5($_GET['password']);
        $model->save();

        return "";
    }

}