<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCssFile('css/fontello/css/fontello-ie7.css',['condition'=>'IE 7'])  ?>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>
<header>
<div class="container clearfix">
    <a href="/" class="logo blue left"><img src="/img/logo.svg">Free Travel</a>
    <nav class="general">
        <a href="#" class="menu_item white">Лучшее за неделю</a>
        <a href="#" class="menu_item white">Топ 20</a>
        <label for="showauthentication" class="menu_item showauthentication">Вход/Регистрация</label>
        <div class="authentication">
            <input type="checkbox" id="showauthentication"/>
            <label for="showauthentication" class="back inner">
                <div class="auth_container">
                    <div class="auth_form_container left">
                        <h3 class="white">Войти</h3>
                        <form>
                            <input type="text" placeholder="Логин">
                            <input type="password" placeholder="Пароль">
                            <input type="submit" value="Войти">
                        </form>
                        <a href="#" class="lost_password white">Востановить пароль</a>
                    </div>
                    <div class="auth_form_container right">
                        <h3 class="white">Зарегистрироваться</h3>
                        <form>
                            <input type="text" placeholder="Логин">
                            <input type="password" placeholder="Введите пароль">
                            <input type="password" placeholder="Повторите пароль">
                            <input type="email" placeholder="E-mail">
                            <input type="submit" value="Зарегистрироваться">
                        </form>
                    </div>
                    <div class="social_auth">
                        <h3 class="white">войти через социальную сеть</h3>
                        <div>
                            <a class="vkontakte"><i class="icon icon-vkontakte white"></i></a>
                            <a class="google"><i class="icon icon-google white"></i></a>
                            <a class="twitter"><i class="icon icon-twitter white"></i></a>
                            <a class="facebook"><i class="icon icon-facebook white"></i></a>
                            <a class="odnoklassniki"><i class="icon icon-odnoklassniki white"></i></a>
                        </div>
                    </div>
                </div>
            </label>
        </div>
    </nav>
    <nav class="mobile">
        <input type="checkbox" id="showmenu" class="nav"/>
        <label for="showmenu" class="showmenu">&#9776;</label>
        <label for="showmenu" class="back"></label>
        <ul>
            <li><a href="#">Лучшее за неделю</a></li>
            <li><a href="#">Топ 20</a></li>
            <li><a href="auth.html">Вход/Регистрация</a></li>
        </ul>
    </nav>
</div>
</header>
<?= $content ?>
<footer>
    <div class="container">
        <div class="header clearfix">
            <div class="left">
                <a href="/" class="logo white">Free Travel</a>
            </div>
            <div class="right">
                <a href="#" class="white">пожаловаться</a>
                <a href="#" class="white">контакты</a>
                <a href="#" class="white">о нас</a>
            </div>
        </div>
        <div class="copyright white">
            &copy; SmartGeek 2017
        </div>
    </div>
</footer>
<?php
$this->registerJs('$( function() {
        $( ".datepicker" ).datepicker( $.datepicker.regional[ "ru" ] );
    } );');
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
