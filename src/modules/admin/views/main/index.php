<?php
/** @var $this \yii\web\View */

use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

$this->title = 'Exchange Admin Panel'


?>
<div class="admin-index">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Активные заявки</h2>

            <table class="table table-bordered">
                <?php foreach($orders as $order): ?>
                <tr>
                    <td>
                        <?=$order->exchange->from->title?> <?=$order->from_value?> <?=$order->exchange->from->type?> =>
                        <?=$order->exchange->to->title?> <?=$order->to_value?> <?=$order->exchange->to->type?>
                    </td>
                    <td>
                        <?=$order->card?><br>
                        <?=$order->bank?><br>
                        <?=$order->fio?><br>
                        <?=$order->wallet?><br>
                        <?=$order->email?><br>
                    </td>
                    <td>
                        <?=$order->date?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-lg-12">
            <h2 class="page-header">Направления обмена</h2>

            <nav>
                <?php foreach($currency as $item): ?>
                    <a class="btn btn-sm btn-<?=$item->id == $cur->id ? 'info':'default'?>" href="<?=\yii\helpers\Url::to(['main/index', 'currency_from'=>$item->id])?>"><?=$item->title?></a>
                <?php endforeach; ?>
            </nav>

            <?php $form = ActiveForm::begin(); ?>

            <?= MultipleInput::widget([
                'max' => 50,
                'name'=>'directions',
                'data'=>$directions,
                'columns' => [
                    [
                        'name'  => 'static',
                        'type'  => 'static',
                        'value' => function($data) use ($cur) {
                            return \yii\helpers\Html::tag('h5', $cur->title. ' ' .$cur->type, ['class' => '']);
                        },
                        'title' => 'Обмен с',
                    ],
                    [
                        'name'  => 'currency_to',
                        'type'  => 'dropDownList',
                        'title' => 'на',
                        'items' => \yii\helpers\ArrayHelper::map(\app\models\Currency::find()->all(), 'id', 'title')
                    ],
                    [
                        'name'  => 'course',
                        'type'  => 'textInput',
                        'title' => 'курс',
                        'defaultValue'=>'1.00',
                        'headerOptions' => [
                            'style' => 'width: 100px;',
                        ]
                    ],
                    [
                        'name'  => 'exchange_percent',
                        'type'  => 'textInput',
                        'title' => 'проценты (%)',
                        'defaultValue'=>'1',
                        'headerOptions' => [
                            'style' => 'width: 70px;',
                        ]
                    ],
                    [
                        'name'  => 'min',
                        'type'  => 'textInput',
                        'title' => 'мин.сумма',
                        'defaultValue'=>'1',
                        'headerOptions' => [
                            'style' => 'width: 150px;',
                        ]
                    ],
                    [
                        'name'  => 'max',
                        'type'  => 'textInput',
                        'title' => 'макс.сумма',
                        'defaultValue'=>'100000',
                        'headerOptions' => [
                            'style' => 'width: 150px;',
                        ]
                    ],
                    [
                        'name'  => 'min_comission',
                        'type'  => 'textInput',
                        'title' => 'мин.комиссия',
                        'defaultValue'=>'1',
                        'headerOptions' => [
                            'style' => 'width: 70px;',
                        ]
                    ],
                    [
                        'name'  => 'enabled',
                        'type'  => 'checkbox',
                        'title' => 'вкл',
                        'defaultValue'=>'1',
                        'headerOptions' => [
                            'style' => 'width: 70px;',
                        ]
                    ],

                ]
            ]);
            ?>
            <div class="form-group">
                <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-success' ]) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
