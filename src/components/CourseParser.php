<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 08.12.16
 * Time: 8:02
 */

namespace app\components;

use app\models\Currency;
use app\models\ExchangeDirection;
use app\models\Order;
use app\models\ReferalStatistic;
use app\models\User;
use Yii;
use yii\base\Object;

class CourseParser extends Object
{

    public $usdId = 'R01235';
    public $cbrDaily = 'http://www.cbr.ru/scripts/XML_daily.asp';

		protected function process($url = 'https://btc-e.com/api/3/ticker/btc_usd-btc_rur'){
			return json_decode(file_get_contents($url));
		}

    public function init() {
				//var_dump($this->process());
				//$BTCeAPI->getPairDepth('btc_usd');

				if(!$this->check('btc', 'USD')){
					$this->coin('btc', 'USD');
				}
				if(!$this->check('btc', 'RUR')){
					$this->coin('btc', 'RUR');
				}

				if(!$this->check('USD', 'btc')){
					$this->coin('USD', 'btc');
				}
				if(!$this->check('RUR', 'btc')){
					$this->coin('RUR', 'btc');
				}

				$cookies = Yii::$app->response->cookies;
				$referal = Yii::$app->request->get('rid');

				if ($referal) {
					$cookies->add(new \yii\web\Cookie([
							'name' => 'referer',
							'value' => $referal,
					]));

					$user_id = $referal;
					$user = User::findOne(['id'=>$user_id]);
					$stat = ReferalStatistic::find()->where(['user_id'=>$user_id])->one();

					if(!$stat && $user){
						$stat = new ReferalStatistic();
						$stat->user_id = $user_id;
						$stat->incoming = $stat->incoming+1;
						$stat->save();
					} else {
						$stat->incoming = $stat->incoming+1;
						$stat->save();
					}
				}

        if(!$this->check('RUR', 'USD')){
            $this->usd();
        }

        if(!$this->check('USD', 'RUR')){
            $this->usd('USD', 'RUR');
        }

        $ordersToReturn = Order::find()->where(['status'=>Order::STATUS_IN_WORK])->andWhere(['<', 'date', date('Y-m-d H:i:s', strtotime("-30 minutes"))])->all();
				if($ordersToReturn){
					//var_dump($ordersToReturn);die;
					foreach($ordersToReturn as $order){
						$this->returnReserve($order);
					}
				}

        parent::init();
    }

    protected function usd($from = 'RUR', $to = 'USD'){
        $xml = file_get_contents($this->cbrDaily);
        $array=json_decode(json_encode(simplexml_load_string($xml)),true);
        $index = array_search(['ID'=>$this->usdId], array_column($array['Valute'], '@attributes'));

        $course = (float)str_replace(',', '.', $array['Valute'][$index]['Value']);

        if($from == 'RUR' && $to == 'USD') {
            $course = 1/$course;
        }

        $model = \app\models\CourseParser::findOne(['from'=>$from, 'to'=>$to]);
        if(!$model){
            $model = new \app\models\CourseParser();
            $model->from = $from;
            $model->to = $to;
        }
        $model->value = $course;
        $model->updated = date('Y-m-d');
        $model->save();

        $directions = ExchangeDirection::find()
            ->joinWith([
                'from' => function ($query) {
                    $query->from(Currency::tableName() . ' c1');
                },
                'to' => function ($query) {
                    $query->from(Currency::tableName() . ' c2');
                },
            ])->where(['c1.type'=>$from])->andWhere(['c2.type'=>$to])->all();

        foreach($directions as $direction) {
            // if($direction)
            $direction->course = $course;
            $direction->save();
        }

        return true;

    }

    protected function coin($from = 'btc', $to = 'USD'){
			if($to == 'btc') {
				$course = $this->process()->{'btc_'.strtolower($from)}->last;
			} else {

				$course = $this->process()->{'btc_'.strtolower($to)}->last;
			}

			if($to == 'btc') {
				$course = 1/$course;
			}

			$model = \app\models\CourseParser::findOne(['from'=>$from, 'to'=>$to]);
			if(!$model){
				$model = new \app\models\CourseParser();
				$model->from = $from;
				$model->to = $to;
			}
			$model->value = $course;
			$model->updated = date('Y-m-d');
			$model->save();

			$directions = ExchangeDirection::find()
					->joinWith([
							'from' => function ($query) {
								$query->from(Currency::tableName() . ' c1');
							},
							'to' => function ($query) {
								$query->from(Currency::tableName() . ' c2');
							},
					])->where(['c1.type'=>$from])->andWhere(['c2.type'=>$to])->all();

			foreach($directions as $direction) {
				// if($direction)
				$direction->course = $course;
				$direction->save();
			}
    }

    public function returnReserve(Order $order){
    	if($order->exchange):
    		$currency = $order->exchange->getTo()->one();
    		$currency->reserve = round((float)$currency->reserve + (float)$order->to_value, 2);

				if(!$currency->save()){
					var_dump($currency, $currency->getErrors());die;
				}
				$order->status = Order::STATUS_INACTIVE;
				return $order->save();
			endif;
			return false;
		}

    protected function check($from, $to){
        return (bool)\app\models\CourseParser::findOne(['from'=>$from, 'to'=>$to, 'updated'=>date('Y-m-d')]);
    }

}