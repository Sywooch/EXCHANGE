<?php


namespace app\models;

use dektrium\user\helpers\Password;
use dektrium\user\models\Token;
use dektrium\user\models\User as BaseUser;

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

			$this->mailer->sendWelcomeMessage($this, isset($token) ? $token : null);
			$this->trigger(self::AFTER_REGISTER);

			$transaction->commit();

			return true;
		} catch (\Exception $e) {
			$transaction->rollBack();
			\Yii::warning($e->getMessage());
			return false;
		}
	}



	public function getOrders() {
		return $this->hasMany(Order::className(), [
				'user_id'=>'id'
		])->orderBy('date DESC');
	}


}