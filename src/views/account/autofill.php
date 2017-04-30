<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:58
 */
use yii\helpers\Url;
 
$this->title = 'Личный кабинет';
$this->params['showFirms'] = true;
?>

		<div class="lk-main">
			<div class="settings">
				<div class="links">
					<a href="<?=Url::to(['autofill'])?>"><button class="ah-button ah-button-orange">автозаполнение</button></a>
					<a href="<?=Url::to(['security'])?>"><button class="ah-button ah-button-orange">безопасность</button></a>
				</div>
				<div class="text">
					<p>Для более быстрого создания заявки на нашем сайте Вы можете воспользоваться функцией «Автозаполнение данных».</p>
					<p class="strong">Для этого:</p>
					<ul>
						<li>Выберите из списка нужную Вам платежную систему или Банк.</li>
						<li>Введите реквизиты (Кошелёк, счёт или карта, ФИО, УНК и т.д.)</li>
						<li>Нажмите на кнопку «Сохранить».</li>
					</ul>
					<p>Теперь при создании заявки на нашем сайте Вам больше не нужно будет вспоминать номер своего кошелька или банковской карты.
					При заполнении реквизитов достаточно будет просто нажать «+» рядом с формой ввода данных.</p>
				</div>
			</div>
			<!--<div class="currencies-list">
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-01.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-02.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-03.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-04.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-05.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-06.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-07.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-08.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-09.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-10.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-11.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-12.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
			</div>-->
		</div>

			</div>
		</section>
    </div>
</main>