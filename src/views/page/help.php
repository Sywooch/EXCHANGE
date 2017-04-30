<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 5:33
 */
use yii\helpers\Url;
$this->title = 'Помощь';
?>
<main>
   <div class="ah-wrapper page">
       <div class="ah-breadcrumbs">
           <ul>
               <li><a href="<?=Url::home()?>">главная</a></li>
               <li><?=$this->title?></li>
           </ul>
       </div>
       <h1><?=$this->title?></h1>
       <section class="ah-partners">
            <div class="ah-content">                
                <div class="ah-text">
                    <p>Наша система оказывает незаменимую поддержку при обмене любых электронных валют, а так же помогает с выводом средств на карту многих банков. Мы предоставляем качественные услуги в нашем обменном пункте онлайн, который позволяет произвести любую операцию, не выходя из дома.</p>
                    <p>Если у вас возник какой-либо вопрос, то можете найти ответ на страницах раздела “Помощь”. Для этого выберите необходимый раздел и перейдите по подходящей ссылке.</p>
                    <h3 class="ah-title">Не нашли ответ на свой вопрос в этом разделе? Задайте вопрос в службу техподдержки</h3>                    
                </div>
                <div class="ah-footer"><button id="question_dialog_btn" class="ah-button ah-button-orange js-button-question">Задать вопрос</button></div>
            </div>
            <aside id="help">
                <div class="ah-panel ah-panel-green ah-reviews ah-bg-nah">
                    <div class="ah-header">
                        <h2 class="ah-arrows ah-blue">ПРОВЕРКА СТАТУСА ВОПРОСА</h2>
                    </div>
                    <div class="ah-content">
                        <form action="" method="post" class="">
                            <p>Если вы уже отправили свой вопрос в службу техподдержки
                                и ждете на него ответ, то введите номера вопроса ниже,
                                чтобы проверить текущий статус.
                                Номер можно посмотреть на почте, которую вы указали
                                при заполнении формы вопроса.</p>
                            <div class="ah-form-field">
                                <label for="ticket_num">Введите номер тикета:</label>
                                <input id="ticket_num" required type="text" placeholder="" name=""/>                                
                            </div>
                            <div class="ah-form-submit">
								<input required type="submit" value="ПЕРЕЙТИ" class="ah-button ah-button-orange"/>
							</div>
                        </form>
                    </div>
                </div>
            </aside>
       </section>
   </div>
   <div id="question_dialog" class="ah-popup js-popup-question ah-hidden">
        <div class="ah-popup-bg"></div>
		<div class="ah-popup-content">
			<div class="ah-panel ah-panel-green2 ah-bg-nah">
				<div class="ah-header">
					<h4>ОТПРАВТЕ ВОПРОС</h4>
				</div>
                <div class="ah-content">
					<form action="" method="post" class="">
						<div class="ah-form-field">
							<input type="text" placeholder="Как Вас зовут" />
						</div>
						<div class="ah-form-field">
							<input type="text" placeholder="Email" />
						</div>
						<div class="ah-form-field">
							<select>
                                <option>Выберите тему</option>
                            </select>
						</div>
                        <div class="ah-form-field">
							<input type="text" placeholder="Номер заявки" />
						</div>
                        <div class="ah-form-field">
							<input type="text" placeholder="Заголовок вопроса" />
						</div>
                        <div class="ah-form-field">
							<textarea placeholder="Ваш вопрос"></textarea>
						</div>
						<div class="ah-form-submit">
							<input required type="submit" value="ОТПРАВИТЬ" class="ah-button ah-button-orange"/>
						</div>
					</form>
					<div class="ah-button-close js-popup-close"></div>
                </div>
            </div>
        </div>
   </div>
</main>