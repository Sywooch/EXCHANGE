<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 19.12.16
 * Time: 3:03
 */

namespace app\components;


use app\models\Order;
use app\models\Settings;
use yii\base\Object;

class MailInformer extends Object
{

	const TAG_SITEURL = '<SITEURL>';
	const TAG_ORDERINFO = '<ORDERINFO>';
	const TAG_CREDENTIALS = '<CREDENTIALS>';
	const TAG_ORDERSTATUS = '<ORDERSTATUS>';
	const TEMPLATE_REGISTER = 3;
	const TEMPLATE_ORDER = 2;
	const TEMPLATE_STATUS = 4;


	public static function send($template, $subject = 'Информер', $receiver, $param = false){
		$mailer = \Yii::$app->mailer;
		$sender = isset(\Yii::$app->params['adminEmail']) ? \Yii::$app->params['adminEmail'] : 'no-reply@example.com';
		return $mailer->compose()
				->setTo($receiver)
				->setFrom($sender)
				->setSubject($subject)
				->setHtmlBody(self::parseTemplate($template, $param))
				->send();
	}

	protected function parseTemplate($id, $param = false){
		$template = htmlspecialchars_decode(Settings::findOne(['id'=>$id])->content);

		//var_dump($template);die;

		$template = str_replace(self::TAG_SITEURL, \Yii::$app->urlManager->createAbsoluteUrl(['site/index']), $template);



		if($id == self::TEMPLATE_REGISTER){
			$credentials = '<table>
				<tr><td>Логин: </td><td>'.$param->username.'</td></tr>
				<tr><td>Пароль: </td><td>'.$param->password.'</td></tr>
				</table>';
			$template = str_replace(self::TAG_CREDENTIALS, $credentials, $template);
		}
		if($id == self::TEMPLATE_ORDER){
			$order = $param;

			$orderinfo = '<table>
			<tr><td>Номер заявки: </td><td>'.$order->id.'</td></tr>
			<tr><td>Направление обмена: </td>
				<td>'.$order->exchange->from->title.' '
						.$order->from_value.' '
						.$order->direction->from->type.' => '
						.$order->exchange->to->title.' '
						.$order->to_value.' '
						.$order->direction->to->type.' курс '
						.$order->direction->course
						.'</td></tr>
			<tr><td>Дата: </td><td>'.\Yii::$app->formatter->asDate($order->date, 'php:d.m.Y H:i:s').'</td></tr>
			</table>';
			$template = str_replace(self::TAG_ORDERINFO, $orderinfo, $template);
		}
		if($id == self::TEMPLATE_STATUS){
			$order = $param;

			$orderinfo = '<table>
			<tr><td>Номер заявки: </td><td>'.$order->id.'</td></tr>
			<tr><td>Направление обмена: </td>
				<td>'.$order->exchange->from->title.' '
					.$order->exchange->from_value.' '
					.$order->direction->from->type.' => '
					.$order->exchange->to->title.' '
					.$order->exchange->to_value.' '
					.$order->direction->to->type.' курс '
					.$order->direction->course
					.'</td></tr>
			<tr><td>Дата: </td><td>'.\Yii::$app->formatter->asDate($order->date, 'php:d.m.Y H:i:s').'</td></tr>
			</table>';
			if($order->status == Order::STATUS_INACTIVE){
				$status = 'Отклонено';
			}
			if($order->status == Order::STATUS_ACCEPTED){
				$status = 'Проведено';
			}
			if($order->status == Order::STATUS_PAYED_USER){
				$status = 'Оплачено';
			}
			if($order->status == Order::STATUS_IN_WORK){
				$status = 'В процессе обработки';
			}
			$template = str_replace(self::TAG_ORDERINFO, $orderinfo, $template);
			$template = str_replace(self::TAG_ORDERSTATUS, $status, $template);
		}


		return $template;
	}



}