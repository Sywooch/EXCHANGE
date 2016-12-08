<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ExchangeDirectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exchange Directions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-direction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exchange Direction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'currency_from',
            'currency_to',
            'course',
            'exchange_percent',
            // 'min',
            // 'max',
            // 'min_comission',
            // 'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
