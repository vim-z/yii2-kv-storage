<?php


namespace vimZ\kvStorage\widgets;


use dosamigos\datepicker\DatePicker;
use vimZ\kvStorage\models\forms\KvStorageForm;
use vimZ\kvStorage\models\KvStorage;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

class KvStorageWidget extends Widget
{
    /**
     * @var ActiveForm;
     */
    public $form;

    public $type;

    public $model;

    public $attribute;

    public $value;

    public function run()
    {
        switch ($this->type) {
            case KvStorage::TYPE_TEXT:
                $field = $this->form->field($this->model, $this->attribute);
                $input = $field->textInput();
                break;
            case KvStorage::TYPE_WETHER:
                $field = $this->form->field($this->model, $this->attribute);
                $input = $field->dropDownList([0 => '否', 1 => '是']);
                break;
            case KvStorage::TYPE_DATE:
                $field = $this->form->field($this->model, $this->attribute);
                $input = $field->widget(DatePicker::className());
                break;
            case  KvStorage::TYPE_RATIO:
                $formName = substr($this->model::className(), strrpos($this->model::className(), '\\') + 1);
                $input = '
                    <div class="form-group field-kvstorageform-value required">
                    <label class="control-label" for="kvstorageform-value">' . $this->attribute . '</label>
                    <div class="row">
                    ' . Html::textInput($formName . '[value1]',$this->value,['class' => 'form-control col-lg-5']) . ':' . Html::textInput($formName . '[value2]') . '
                    </div>
                    <div class="help-block"></div>
                    </div>
                    ';
                break;
        }

        echo $input;
    }
}