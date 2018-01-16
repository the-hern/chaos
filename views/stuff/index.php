<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StuffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stuffs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stuff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stuff', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'bin_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
