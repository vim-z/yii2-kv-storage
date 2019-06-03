<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel vimZ\kvStorage\models\KvStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('kv-storage', 'Kv Storages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kv-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('kv-storage', 'Create Kv Storage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'key',
            'value:ntext',
            'type',
            'tip',
            'comment:ntext',
            //'updated_at',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
