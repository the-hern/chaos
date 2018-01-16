<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bin */

$this->title = 'Create Bin';
$this->params['breadcrumbs'][] = ['label' => 'Bins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
