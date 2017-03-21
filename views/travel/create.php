<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Travel */

$this->title = 'Создать свое путешествие';
$this->params['breadcrumbs'][] = ['label' => 'Travels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<main class="page_new_travel">
    <!--    <form>-->
    <?php $form = ActiveForm::begin(); ?>
    <div class="header_with_map clearfix">
        <div class="container">
            <h1 class="white"><?= Html::encode($this->title) ?></h1>
            <div class="left">
                <div class="container_1_element">
                    <div>
                                                <label for="create_a_travel_city-from" class="white">откуда</label>
                        <span class="input_wrapper">
            <input type="text" placeholder="Город" id="create_a_travel_city-from">
                            <?/*= $form->field($model, 'start_point', [
                                'options' => [
                                    'class' => 'input_wrapper'
                                ],
                            ])->textInput([
                                'placeholder' => 'Город',
                                'id' => 'create_a_travel_city-from',
                            ])->label('откуда', ['class' => 'white']) */?>
                        </span>
                    </div>
                    <div>
                        <!--                        <label for="create_a_travel_city-to" class="white">куда</label>-->
<!--                        <span class="input_wrapper">-->
<!--            <input type="text" placeholder="Город" id="create_a_travel_city-to">-->
                            <?= $form->field($model, 'end_point', [
                                'options' => [
                                    'class' => 'input_wrapper',
                                ]
                            ])->textInput([
                                'placeholder' => 'Город',
                                'id' => 'create_a_travel_city-to',
                            ])->label('куда', ['class' => 'white']) ?>
<!--                        </span>-->
                    </div>
                    <div>
                        <label for="datepicker1" class="white">начало</label>
                        <span class="input_wrapper">
                      <input type="text" id="datepicker1" placeholder="дд.мм.гггг" name="date" class="datepicker blue"
                             value=""/>
              </span>
                    </div>
                    <div>
                        <label for="datepicker2" class="white">конец</label>
                        <span class="input_wrapper">
                      <input type="text" id="datepicker2" placeholder="дд.мм.гггг" name="date" class="datepicker blue"
                             value=""/>
              </span>
                    </div>
                    <div>
                        <label for="create_a_travel_transport" class="white">на чём</label>
                        <span class="input_wrapper">
            <select id="create_a_travel_transport" class="selectmenu blue">
              <option value="" selected="selected">на своих двоих</option>
              <option value="">на велосипеде</option>
              <option value="">на машине</option>
              <option value="">на чём–то другом</option>
            </select>
              </span>
                    </div>
                    <div>
                        <label for="create_a_travel_reason" class="white">зачем</label>
                        <span class="input_wrapper">
            <select id="create_a_travel_reason" class="selectmenu blue">
              <option value="" selected="selected">за впечатлениями</option>
              <option value="">за крутыми селфи</option>
              <option value="">за сокровищами</option>
              <option value="">за компанию</option>
              <option value="">за чем–то другим</option>
            </select>
              </span>
                    </div>
                </div>
            </div>
            <div class="map_index_2">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="create_a_travel clearfix">
            <!-- ЛЕВАЯ КОЛОНКА -->
            <div class="container_3_elements">
                <label for="create_a_travel_description" class="blue">Краткое описание маршрута</label>
                <textarea id="create_a_travel_description"
                          placeholder="Хочу доехать на велосипеде до посёлка вороского и пособирать грибы в местных лесах. Кто со мной?"></textarea>
            </div>
            <!--  ПРАВАЯ КОЛОНКА -->
            <div class="right_form_container">
                <div class="container_2_elements">
                    <div>
                        <label for="create_a_travel_foto-foto" class="blue">загрузить фото</label>
                        <span class="blue">Выберите файл <i class="icon icon-inbox"></i></span>
                        <input type="file" id="create_a_travel_foto-foto" accept="image/jpeg,image/png,image/gif">
                    </div>
                    <div>
                        <label for="create_a_travel_difficulty" class="blue">сложность</label>
                        <input type="range" min="0" max="100" step="1" value="50" id="create_a_travel_difficulty">
                    </div>
                    <div>
                        <label for="create_a_travel_foto-map" class="blue">загрузить карту</label>
                        <span class="blue">Выберите файл <i class="icon icon-inbox"></i></span>
                        <input type="file" id="create_a_travel_foto-map"
                               accept="image/*,image/jpeg,image/png,image/gif">
                    </div>
                    <div>
                        <label for="create_a_travel_radio" class="blue">Статус маршрута</label>
                        <div class="radio_yes_no" id="create_a_travel_radio">
                            <input type="radio" id="yes" name="checkbox_yes_no">
                            <label for="yes" class="yes blue">Планируемый</label>
                            <input type="radio" checked id="no" name="checkbox_yes_no">
                            <label for="no" class="blue">Завершенный</label>
                        </div>
                    </div>
                    <input type="submit" value="создать маршрут">
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <!--    </form>-->
</main>