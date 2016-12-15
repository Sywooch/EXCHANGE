<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 5:33
 */

$this->title = 'Помощь';
?>
<div class="full-page">
	<div class="container">
		<h1><span>П</span>омощь</h1>
		<div class="text help-text">
			<p>Наша система оказывает незаменимую поддержку при обмене любых электронных валют, а так же помогает с выводом средств на карту многих банков. Мы предоставляем качественные услуги в нашем обменном пункте онлайн, который позволяет произвести любую операцию, не выходя из дома.</p>
			<p>Если у вас возник какой-либо вопрос, то можете найти ответ на страницах раздела “Помощь”. Для этого выберите необходимый раздел и перейдите по подходящей ссылке.</p>
			<div class="ask-title">Не нашли ответ на свой вопрос в этом разделе? Задайте вопрос в службу техподдержки</div>
			<div class="ask"><button id="question_dialog_btn">Задать вопрос</button></div>
		</div>
	</div>
</div><!-- /.full-page -->


<div id="question_dialog">
	<div class="d-title">Отправьте вопрос <div>в службу техподдержки</div></div>
	<form>
		<input type="text" placeholder="Как Вас зовут" />
		<input type="text" placeholder="Email" />
		<select>
			<option>Выберите тему</option>
		</select>
		<input type="text" placeholder="Номер заявки" />
		<input type="text" placeholder="Заголовок вопроса" />
		<textarea placeholder="Ваш вопрос"></textarea>
		<input type="submit" value="Отправить" />
	</form>
</div>