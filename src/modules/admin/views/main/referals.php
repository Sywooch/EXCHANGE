<?php
/** @var $this \yii\web\View */

use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

$this->title = 'Exchange Admin Panel';

$status = ['Отклонен', '', 'Не оплачен', 'Оплачен', 'Проведён', 'referals'=>'Реферальные'];
?>
<div class="admin-index main-page">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Заявки "<?= $status[$sts] ?>"</h2>
            <div class="btn-group">
                <p><?php foreach ($status as $k => $item) {
                    if ($item) {
                      echo Html::a($item, Url::to(['main/index', 'status' => $k]), ['class' => $sts === $k ? 'btn btn-default' : 'btn btn-info']);
                    }
                  } ?></p>
            </div>

          <?= $orders ? TabularInput::widget([
              'models' => $orders,
              'columns' => [
                  [
                      'name' => 'id',
                      'title' => '№',
                      'type' => 'static'
                  ],
                  [
                      'name' => 'user_id',
                      'title' => 'Пользователь',
                      'type' => 'static',
                      'value' => function ($order) {
                        return Html::tag('span', $order->user->username);
                      }
                  ],
                  [
                      'name' => 'date',
                      'title' => 'Дата',
                      'type' => 'static'
                  ],
                  [
                      'name' => 'wallet',
                      'title' => 'Кошелек',
                      'type' => 'static',
                      'value' => function ($order) {
                        return Html::tag('span', $order->wallet);
                      }
                  ],

                  [
                      'name' => 'currency_id',
                      'title' => 'Валюта',
                      'type' => 'static',
                      'value' => function ($order) {
                        return Html::tag('span', $order->currency->title.' '.$order->currency->type);
                      }
                  ],
                  [
                      'name' => 'status',
                      'title' => 'Статус',
                      'type' => 'dropDownList',
                      'items' => [
                          0 => 'Отклонить',
                          4 => 'Проведён'
                      ]
                  ],
              ],
          ]) : '' ?>


            <div class="text-right"><a href="" class="btn btn-primary" id="save-referal-orders">Сохранить</a></div>


            <br><br><br><br><br>


        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>