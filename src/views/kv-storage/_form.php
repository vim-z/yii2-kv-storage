<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vimZ\kvStorage\assets\DatePickerAsset;

/* @var $this yii\web\View */
/* @var $model vimZ\kvStorage\models\KvStorage */
/* @var $form yii\widgets\ActiveForm */
DatePickerAsset::register($this);
$this->registerJs('
    $(function () {
        $(\'#reservationtime\').daterangepicker({ 
            timePicker: true, 
            timePickerIncrement: 1, 
            "timePicker24Hour": true,
            timePickerSeconds: true,
            locale: {
                applyLabel: "确认",
                cancelLabel: "取消",
                resetLabel: "重置",
          		format: \'YYYY-MM-DD HH:mm:ss\',
          		daysOfWeek: [\'日\', \'一\', \'二\', \'三\', \'四\', \'五\', \'六\'],
                monthNames: [\'一月\', \'二月\', \'三月\', \'四月\', \'五月\', \'六月\', \'七月\', \'八月\', \'九月\', \'十月\', \'十一月\', \'十二月\'],
       	    },
            opens: \'left\',
        });
    });
', \yii\web\View::POS_END)
?>

<?php \yii\widgets\Pjax::begin() ?>

<div class="kv-storage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tip')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'type')->dropDownList($model->getType()) ?>
    <?php } ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label>Date and time range:</label>

        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            <input type="text" class="form-control pull-right" id="reservationtime">
        </div>
        <!-- /.input group -->
    </div>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('kv-storage', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \yii\widgets\Pjax::end() ?>
