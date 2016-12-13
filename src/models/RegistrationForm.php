<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 22:46
 */

namespace app\models;
use Yii;
use yii\web\Response;


class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
	/**
	 * @var string
	 */
	public $source;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = parent::rules();
		$rules['sourceLength']   = ['source', 'string', 'max' => 255];
		return $rules;
	}

	public function attributeLabels()
	{
		return [
				'email'    => 'Email',
				'username' => 'Username',
				'password' => 'Пароль',
				'source' => 'Источник информации о сервисе',
		];
	}

	public function register()
	{

		Yii::$app->response->format = Response::FORMAT_JSON;

		$this->username = $this->username ? $this->username : explode('@',$this->email)[0];
		if (!$this->validate()) {
			return false;
		}

		/** @var User $user */
		$user = Yii::createObject(User::className());
		$user->setScenario('register');
		$this->loadAttributes($user);

		if (!$user->register()) {
			return false;
		}

		return true;
	}
}