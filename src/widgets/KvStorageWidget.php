<?php


namespace vimZ\kvStorage\widgets;

use dosamigos\datetimepicker\DateTimePicker;
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
                $input = $field->widget(DateTimePicker::className(), [
                    'language' => \Yii::$app->language,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii:00',
                        'todayBtn' => true
                    ]
                ]);
                break;
            case  KvStorage::TYPE_RATIO:
                $and = ':';
            case KvStorage::TYPE_TEXT_RANGE:
                if ($this->type == KvStorage::TYPE_TEXT_RANGE) {
                    $and = 'to';
                }
                $formName = substr($this->model::className(), strrpos($this->model::className(), '\\') + 1);
                $input = '
                    <div class="form-group field-kvstorageform-value required">
                    <label class="control-label" for="kvstorageform-value">' . $this->attribute . '</label>' .
                    Html::textInput($formName . '[' . $this->attribute . ']' . '[0]', $this->value[0], ['class' => 'form-control col-lg-5']) .
                    '<div class="">' .
                    $and .
                    '</div>' .
                    Html::textInput($formName . '[' . $this->attribute . ']' . '[1]', $this->value[1], ['class' => 'form-control col-lg-5']) . '
                    <div class="help-block"></div>
                    </div>
                    ';
                break;
            case KvStorage::TYPE_DATE_RANGE:
                $formName = substr($this->model::className(), strrpos($this->model::className(), '\\') + 1);
                $input = '
                    <div class="form-group field-kvstorageform-value required">
                    <label class="control-label" for="kvstorageform-value">' . $this->attribute . '</label>' .
                    DateTimePicker::widget([
                        'name' => $formName . '[' . $this->attribute . ']' . '[0]',
                        'language' => \Yii::$app->language,
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd hh:ii:00',
                            'todayBtn' => true
                        ]
                    ])
                    . '<span>to</span>' .
                    DateTimePicker::widget([
                        'name' => $formName . '[' . $this->attribute . ']' . '[1]',
                        'language' => \Yii::$app->language,
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd hh:ii:00',
                            'todayBtn' => true
                        ]
                    ])
                    . '</div>';
                break;
            default:
                $input = '';
        }

        echo $input;
    }
}