<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vimZ\kvStorage\models\KvStorage */

$this->title = Yii::t('kv-storage', 'Create Kv Storage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('kv-storage', 'Kv Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kv-storage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
