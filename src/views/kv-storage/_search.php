<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model vimZ\kvStorage\models\KvStorageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kv-storage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

        <div class="col-lg-4">
            <?= $form->field($model, 'key') ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'tip') ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'type')->dropDownList($model->getType()) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('kv-storage', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('kv-storage', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
