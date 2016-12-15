<?php
/** @var $this \yii\web\View */

use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

$this->title = 'Exchange Admin Panel';

$status = ['Отклонен', '', 'Не оплачен', 'Оплачен', 'Проведён'];
?>
<div class="admin-index main-page">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Заявки "<?= $status[$sts] ?>"</h2>
            <div class="btn-group">
                <p><?php foreach ($status as $k => $item) {
                    if ($item) {
                      echo Html::a($item, Url::to(['main/index', 'status' => $k]), ['class' => $sts == $k ? 'btn btn-default' : 'btn btn-info']);
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
                      'name' => 'from_to',
                      'title' => 'Инфо',
                      'type' => 'static',
                      'value' => function ($order) {
                        return Html::tag('span',
                            $order->exchange->from->title . ' 
                                                    ' . $order->from_value . ' 
                                                    ' . $order->exchange->from->type . ' => ' . $order->exchange->to->title . ' 
                                                    ' . $order->to_value . ' ' . $order->exchange->to->type);
                      }
                  ],
                  [
                      'name' => 'date',
                      'title' => 'Дата',
                      'type' => 'static'
                  ],
                  [
                      'name' => 'fields',
                      'title' => 'Поля',
                      'type' => 'static',
                      'value' => function ($order) {
                        $f = array_map(function ($item) {
                          return Html::tag('div', $item->field->title . ': ' . $item->value);
                        }, $order->fields);
                        return implode(' ', $f) . Html::tag('div', $order->card) .
                            Html::tag('div', $order->bank) .
                            Html::tag('div', $order->fio) .
                            Html::tag('div', $order->wallet) .
                            Html::tag('div', $order->email);
                      }
                  ],
                  [
                      'name' => 'status',
                      'title' => 'Статус',
                      'type' => 'dropDownList',
                      'items' => [
                          0 => 'Отклонить',
                          2 => 'Не оплачен',
                          3 => 'Оплачен',
                          4 => 'Проведён'
                      ]
                  ],
              ],
          ]) : '' ?>


            <div class="text-right"><a href="" class="btn btn-primary" id="save-orders">Сохранить</a></div>


            <br><br><br><br><br>


        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>