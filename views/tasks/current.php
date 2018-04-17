<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Current';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('All Tasks', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    \yii\jui\DatePicker::widget([
        'name' => 'dateFind',
        'value' => $currentDate,
        'language'=>'ru',
        'dateFormat' => 'dd-MM-yyyy',
        'id' => 'dateFind',
    ]);
    ?>
    <div class="btn btn-primary" onclick="document.location.href='index.php?r=tasks%2Fcurrent&date='+getElementById('dateFind').value">Find tasks</div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
