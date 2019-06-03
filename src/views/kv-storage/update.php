<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vimZ\kvStorage\models\KvStorage */

$this->title = Yii::t('kv-storage', 'Update Kv Storage: {name}', [
    'name' => $model->key,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('kv-storage', 'Kv Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'id' => $model->key]];
$this->params['breadcrumbs'][] = Yii::t('kv-storage', 'Update');
?>
<div class="kv-storage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
