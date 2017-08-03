<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publication */

$this->title = Yii::t('app', 'Create Publication');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lang_array' => $lang_array,
    ]) ?>

</div>
