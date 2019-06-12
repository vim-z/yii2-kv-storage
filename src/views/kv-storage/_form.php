<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vimZ\kvStorage\assets\KvStorageAsset;

/* @var $this yii\web\View */
KvStorageAsset::register($this);
?>

<?php \yii\widgets\Pjax::begin() ?>

<div class="kv-storage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tip')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'type')->dropDownList($model->getType()) ?>
    <?php } ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <div class="valueControl">
        <?= $form->field($model, 'value', ['options' => ['id' => 'kv-value-1','class' => 'form-group']])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'value', ['options' => ['id' => 'kv-value-2','class' => 'form-group hide']])->dropDownList([0 => '否', 1 => '是']) ?>
        <div class="form-group hide" id="kv-value-3">
            <label>Value:</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" name="<?= $model->formName() . '[value]' ?>" class="form-control pull-right"
                       id="datepicker">
            </div>
        </div>
        <div class="form-group hide" id="kv-value-4">
            <label>Value:</label>
            <div>
                <div class="fl one">
                    <input type="text" class="form-control">
                </div>
                <div class="fl ot">:</div>
                <div class="fl one">
                    <input type="text" class="form-control">
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="form-group hide" id="kv-value-5">
            <label>Value:</label>
            <div>
                <div class="fl one">
                    <input type="text" class="form-control">
                </div>
                <div class="fl ot">to</div>
                <div class="fl one">
                    <input type="text" class="form-control">
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="form-group hide" id="kv-value-6">
            <label>Value:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" name="<?= $model->formName() . '[value]' ?>"
                       value="2019/07/12 00:00:00 - 2019/07/13 00:00:00" class="form-control pull-right"
                       id="reservationtime">
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('kv-storage', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \yii\widgets\Pjax::end() ?>
