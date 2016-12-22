<?php
/**
 */
namespace app\components;


use DateTime;
use DateTimeInterface;
use DateTimeZone;
use yii\base\InvalidParamException;


class Formatter extends \yii\i18n\Formatter
{
		public $timeZone = 'Europe/Moscow';

	protected function normalizeDatetimeValue($value, $checkTimeInfo = false)
	{
		// checking for DateTime and DateTimeInterface is not redundant, DateTimeInterface is only in PHP>5.5
		if ($value === null || $value instanceof DateTime || $value instanceof DateTimeInterface) {
			// skip any processing
			return $checkTimeInfo ? [$value, true] : $value;
		}
		if (empty($value)) {
			$value = 0;
		}
		try {
			if (is_numeric($value)) { // process as unix timestamp, which is always in UTC
				$timestamp = new DateTime('@' . (int)$value, new DateTimeZone($this->timeZone));
				return $checkTimeInfo ? [$timestamp, true] : $timestamp;
			} elseif (($timestamp = DateTime::createFromFormat('Y-m-d', $value, new DateTimeZone($this->defaultTimeZone))) !== false) { // try Y-m-d format (support invalid dates like 2012-13-01)
				return $checkTimeInfo ? [$timestamp, false] : $timestamp;
			} elseif (($timestamp = DateTime::createFromFormat('Y-m-d H:i:s', $value, new DateTimeZone($this->defaultTimeZone))) !== false) { // try Y-m-d H:i:s format (support invalid dates like 2012-13-01 12:63:12)
				return $checkTimeInfo ? [$timestamp, true] : $timestamp;
			}
			// finally try to create a DateTime object with the value
			if ($checkTimeInfo) {
				$timestamp = new DateTime($value, new DateTimeZone($this->defaultTimeZone));
				$info = date_parse($value);
				return [$timestamp, !($info['hour'] === false && $info['minute'] === false && $info['second'] === false)];
			} else {
				return new DateTime($value, new DateTimeZone($this->defaultTimeZone));
			}
		} catch (\Exception $e) {
			throw new InvalidParamException("'$value' is not a valid date time value: " . $e->getMessage()
					. "\n" . print_r(DateTime::getLastErrors(), true), $e->getCode(), $e);
		}
	}
}