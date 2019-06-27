<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vimZ\kvStorage\assets\KvStorageAsset;

/* @var $this yii\web\View */
KvStorageAsset::register($this);
$this->registerJs('
    var formName = "' . $model->formName() . '";
    var wether = ["否","是"];
', \yii\web\View::POS_HEAD)
?>

<div class="kv-storage-form">

    <?php $form = ActiveForm::begin([
        'enableClientScript' => false,
    ]); ?>

    <?= $form->field($model, 'tip')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'type')->dropDownList($model->getType()) ?>
    <?php } else { ?>
        <?= $form->field($model, 'type', ['inputOptions' => ['class' => 'form-control', 'disabled' => 'disabled']])->dropDownList($model->getType()) ?>
    <?php } ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <div class="valueControl"></div>
    
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('kv-storage', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
