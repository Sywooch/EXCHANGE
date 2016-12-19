<?php


namespace app\models;

use app\components\MailInformer;
use dektrium\user\helpers\Password;
use dektrium\user\models\Token;
use dektrium\user\models\User as BaseUser;
use yii\helpers\ArrayHelper;

class User extends BaseUser
{
	public function attributeLabels()
	{
		return [
				'username'          => 'Username',
				'email'             => 'Email',
				'registration_ip'   => 'Registration ip',
				'unconfirmed_email' => 'New email',
				'password'          => 'Пароль',
				'created_at'        => 'Registration time',
				'confirmed_at'      => 'Confirmation time',
				'source'      => 'Источник информации о сервисе"',
		];
	}
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		// add field to scenarios
		$scenarios['create'][]   = 'source';
		$scenarios['update'][]   = 'source';
		$scenarios['register'][] = 'source';
		return $scenarios;
	}

	public function rules()
	{
		$rules = parent::rules();
		// add some rules
		$rules['sourceLength']   = ['source', 'string', 'max' => 10];

		return $rules;
	}

	public function register()
	{
		if ($this->getIsNewRecord() == false) {
			throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
		}

		$transaction = $this->getDb()->beginTransaction();

		try {
			$this->confirmed_at = $this->module->enableConfirmation ? null : time();
			$this->password     = $this->module->enableGeneratingPassword ? Password::generate(8) : $this->password;

			$this->trigger(self::BEFORE_REGISTER);

			if (!$this->save()) {
				$transaction->rollBack();
				return false;
			}

			if ($this->module->enableConfirmation) {
				/** @var Token $token */
				$token = \Yii::createObject(['class' => Token::className(), 'type' => Token::TYPE_CONFIRMATION]);
				$token->link('user', $this);
			}

			//$this->mailer->sendWelcomeMessage($this, isset($token) ? $token : null, true);
			MailInformer::send(MailInformer::TEMPLATE_REGISTER, 'Вы зарегистрировались на сайте '.\Yii::$app->name,
					$this->email, $this);
			$this->trigger(self::AFTER_REGISTER);

			$transaction->commit();

			return true;
		} catch (\Exception $e) {
			$transaction->rollBack();
			var_dump($e->getMessage());die;
			return false;
		}
	}

	public function getCountRefExchanges($user_id = false){
		if($user_id){
			$ids = [$user_id];
		} else {
			$ids = $this->getReferals()->select(['referal_id'])->asArray()->all();
			$ids = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($ids)), 0);
		}
		$count = Order::find()->where(['in', 'user_id', $ids])->andWhere(['status'=>4])->count();
		$orders = Order::find()->where(['in', 'user_id', $ids])->andWhere(['status'=>4])->all();
		$sumRur = 0;
		$sumUsd = 0;
		$courseRur = (float)CourseParser::findOne(['from'=>'RUR'])['value'];
		$courseUsd = CourseParser::findOne(['from'=>'USD'])['value'];
		foreach($orders as $order){
			if($order->exchange->from->type == 'USD') {
				$sumRur += $order->from_value * $courseUsd;
				$sumUsd += $order->from_value;
			} else if($order->exchange->from->type == 'RUR'){
				$sumRur += $order->from_value;
				$sumUsd += $order->from_value * $courseRur;
			}
		}

		return ['count'=>$count, 'sumRur'=>$sumRur,'sumUsd'=>$sumUsd];
	}

	public function getOrders() {
		return $this->hasMany(Order::className(), [
				'user_id'=>'id'
		])->orderBy('date DESC');
	}


	public function getWallets(){
		return $this->hasMany(UserWallet::className(), [
				'user_id'=>'id'
		]);
	}

	public function getReferals(){
		return $this->hasMany(Referal::className(), [
				'user_id'=>'id'
		]);
	}

	public function getReferer(){
		return $this->hasOne(Referal::className(), [
				'referal_id'=>'id'
		]);
	}

	public function getReferalOrders(){
		return $this->hasMany(ReferalOrder::className(), [
				'user_id'=>'id'
		]);
	}

}