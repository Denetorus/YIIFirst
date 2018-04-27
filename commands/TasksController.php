<?php
/**
 * Created by PhpStorm.
 * User: gfc-c
 * Date: 28.04.2018
 * Time: 0:15
 */

namespace app\commands;


use app\models\Tasks;
use yii\console\Controller;

class TasksController extends Controller
{

    public function actionReminder($CountDays = 3){

        Tasks::SendReminder($CountDays);

    }
}