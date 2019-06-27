<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model vimZ\kvStorage\models\KvStorage */

$this->title = Yii::t('kv-storage', 'Update Kv Storage: {name}', [
    'name' => $model->key,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('kv-storage', 'Kv Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'id' => $model->key]];
$this->params['breadcrumbs'][] = Yii::t('kv-storage', 'Update');
$this->registerJs(is_array($model->value) ? 'var value = [' . $model->value[0] . ',' . $model->value[1] . '];' : 'var value = "' . $model->value . '";', View::POS_HEAD);
?>
<div class="kv-storage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
