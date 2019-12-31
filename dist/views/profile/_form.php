<?php
/**
 * Profiles
 *
 * @package     form of Profile
 * @author      Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright   (C) Copyright - Web Application development
 * @license     Private license
 * @link        https://appwebd.github.io
 * @date        2018-07-30 19:28:33
 * @version     1.0
 */

use app\components\UiComponent;
use app\models\Profile;
use yii\widgets\ActiveForm;
use \app\components\UiButtons;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */

$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    Profile::ICON,
    'is-white',
    $this->title,
    Yii::t(
        'app',
        'Please complete all requested information.'
    ),
    '000',
    false
);


if ($model->isNewRecord) {
    $model->active = 1;
}

$form = ActiveForm::begin(
    [
        'id' => 'form-profile',
        'method' => 'post',
        'options' => ['class' => 'form-vertical '],
    ]
);
echo BREAK_LINE;
echo $form->field($model, Profile::PROFILE_NAME)->textInput(
    [
        MAXLENGTH => true,
        AUTOFOCUS => AUTOFOCUS,
        TABINDEX => 1,
        REQUIRED => REQUIRED,
        AUTOCOMPLETE => 'off',
    ]
)->label();

echo BREAK_LINE;

echo $form->field($model, Profile::ACTIVE)->checkbox(
    [

        AUTOFOCUS => AUTOFOCUS,
        AUTOCOMPLETE => 'off',
        REQUIRED => REQUIRED,
        TABINDEX => 2,
        UNCHECK => 0,


    ]
)->label();

echo BREAK_LINE;

echo $form->errorSummary($model, array(STR_CLASS => "error-summary"));
echo HTML_DIV_CLOSEX2;
$uiButtons = new UiButtons();
$uiButtons->buttonsCreate(3);

ActiveForm::end();


