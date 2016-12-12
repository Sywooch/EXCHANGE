<?php

namespace app\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 7:30
 */
class CustomPager extends LinkPager
{
	public $activePageCssClass = 'current';
	public $nextPageLabel = ' ';
	public $prevPageLabel = ' ';

	protected function renderPageButton($label, $page, $class, $disabled, $active)
	{
		$options = ['class' => empty($class) ? $this->pageCssClass : $class];
		if ($active) {
			Html::addCssClass($options, $this->activePageCssClass);
		}
		if ($disabled) {
			Html::addCssClass($options, $this->disabledPageCssClass);
			return Html::tag('span', $label, $this->disabledListItemSubTagOptions);
		}
		$linkOptions = $this->linkOptions;
		$linkOptions['data-page'] = $page;
		$linkOptions['class'] = $options['class'];

		return Html::a($label, $this->pagination->createUrl($page), $linkOptions);
	}
}