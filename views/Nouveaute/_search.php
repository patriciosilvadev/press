<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NouveauteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nouveaute-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titre') ?>

    <?= $form->field($model, 'libelle_court') ?>

    <?= $form->field($model, 'libelle_long') ?>

    <?= $form->field($model, 'date_creation') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'cree_par') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
