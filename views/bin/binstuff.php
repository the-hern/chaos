<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Stuff */

use app\models\Bin;
use app\models\Stuff;

$this->params['breadcrumbs'][] = ['label' => 'Stuffs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bin_stuff-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'number')->dropDownList($items,
      ['onchange'=>'this.form.submit()'] //options
      )->label('Bin Number') ?>

  <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($newStuffModel, 'name')->textInput(['maxlength' => true])->label('Stuff') ?>
    <?= Html::ActiveHiddenInput($newStuffModel, 'bin_id', ['value'=>$number]); ?>
        <center><?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?></center>
    </div>

    <?php ActiveForm::end(); ?>


    <?= GridView::widget([
        'dataProvider' => $stuffs,
        'columns' => [
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                 'buttons' => [
                     'delete' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['stuffdelete', 'id' => $model['id'], 'bin_id' => $model['bin_id']], [
                              'title' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Record?'),'data-method' => 'post']);
                    }
                 ],
            ],
        ],
    ]); ?>

    </p>
    <p><center><a class="btn btn-lg btn-success" href="?r=bin/create">Add Bin</a></center></p>


</div>
