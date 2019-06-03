<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model vimZ\kvStorage\models\KvStorage */

$this->title = $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('kv-storage', 'Kv Storages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kv-storage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('kv-storage', 'Update'), ['update', 'id' => $model->key], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('kv-storage', 'Delete'), ['delete', 'id' => $model->key], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('kv-storage', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'key',
            'value:ntext',
            'type',
            'tip',
            'comment:ntext',
            'updated_at',
            'created_at',
        ],
    ]) ?>

</div>
