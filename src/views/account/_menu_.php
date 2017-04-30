<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:50
 */
use yii\helpers\Url;

?>
			<div class="title"><span>Л</span>ичный кабинет</div>
			<div class="lk-menu-wrapper">
				<div class="lk-menu">
					<a class="item" href="<?=Url::to(['account/index'])?>">
						<div class="image-wrapper">
							<div class="image">
								<img src="/img/lk-menu-1.png" />
							</div>
						</div>
						<div class="name">заявки</div>
					</a>
					<a class="item" href="<?=Url::to(['account/security'])?>">
						<div class="image-wrapper">
							<div class="image">
								<img src="/img/lk-menu-2.png" />
							</div>
						</div>
						<div class="name">настройки</div>
					</a>
					<a class="item" href="<?=Url::to(['account/referer'])?>">
						<div class="image-wrapper">
							<div class="image">
								<img src="/img/lk-menu-3.png" />
							</div>
						</div>
						<div class="name">реферальная программа</div>
					</a>
					<a class="item" href="<?=Url::to(['account/materials'])?>">
						<div class="image-wrapper">
							<div class="image">
								<img src="/img/lk-menu-4.png" />
							</div>
						</div>
						<div class="name">рекламные материалы</div>
					</a>
					<a class="item" href="<?=Url::to(['account/forms'])?>">
						<div class="image-wrapper">
							<div class="image">
								<img src="/img/lk-menu-5.png" />
							</div>
						</div>
						<div class="name">формы обмена</div>
					</a>
					<div class="line line-1"></div>
					<div class="line line-2"></div>
					<div class="line line-3"></div>
					<div class="line line-4"></div>
					<div class="clearfix"></div>
				</div>
			</div>
