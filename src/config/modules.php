<?php

return array_merge(require(__DIR__ . '/installed_modules.php'), [
   'core' => ['class' => 'app\modules\admin\Module'],
   'admin' => [
       'class' => 'nullref\admin\Module',
       'controllerMap' => [  //controllers
           'user' => 'app\modules\admin\controllers\UserController',
           'main' => 'app\modules\admin\controllers\MainController',
           'currency' => 'app\modules\admin\controllers\CurrencyController',
           'testimonial' => 'app\modules\admin\controllers\TestimonialController',
           'settings' => 'app\modules\admin\controllers\SettingsController',
           'exchange-direction'=>'app\modules\admin\controllers\ExchangeDirectionController',
       ],
   ],
    'yii2images' => [
        'class' => 'rico\yii2images\Module',
        //be sure, that permissions ok
        //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
        'imagesStorePath' => 'images/store', //path to origin images
        'imagesCachePath' => 'images/cache', //path to resized copies
        'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
        //'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
    ],
]);