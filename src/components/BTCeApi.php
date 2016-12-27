<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 27.12.16
 * Time: 8:26
 */

namespace app\components;


use yii\base\Object;

/**
 * API-call related functions
 *
 * @author marinu666
 * @license MIT License - https://github.com/marinu666/PHP-btce-api
 */
class BTCeAPI extends Object
{


	public static function process($url = 'https://btc-e.nz/api/3/ticker/btc_usd-btc_rur'){
		return json_decode(file_get_contents($url));
	}


}