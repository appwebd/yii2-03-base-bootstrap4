<?php
/**
 * Signup
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Signup
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */

use app\components\UiComponent;
use app\models\forms\SignupForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var yii\widgets\ActiveForm $form */
/* @var object $model \app\models\User */

$this->title = Yii::t('app', 'Signup view');
$this->params[BREADCRUMBS][] = $this->title;

echo '
<div class="level">
    <div class="level-item columns">
        <div class="column is-half ">';

$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    'fas fa-user',
    'card-header-background-gray',
    $this->title,
    '',
    '000',
    false
);

$form = ActiveForm::begin(
    [
        'id' => 'form-signup',
        'method' => 'post',
        'fieldClass' => 'app\widgets\ActiveFieldForm',
    ]
);

echo '<div class="block"><p class="is-warning has-text-left">',
Yii::t(
    'app',
    'Please complete all requested information.'
),
'</p></div>';

echo $form->field(
    $model,
    SignupForm::FIRST_NAME,
    [
        OPTIONS => [ICON_LEFT => 'fa-user', ICON_RIGHT => ''],
    ]
)->textInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        PLACEHOLDER => Yii::t('app', 'First name'),
        REQUIRED => REQUIRED,
        STR_CLASS => INPUT,
        TABINDEX => '1',
        TITLE => Yii::t('app', 'First name is required information!'),
        'x-moz-errormessage' => Yii::t('app', 'First name is required information!'),
    ]
)->label(false);

echo $form->field(
    $model,
    SignupForm::LAST_NAME,
    [
        OPTIONS => [ICON_LEFT => 'fa-user', ICON_RIGHT => ''],
    ]
)->textInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        PLACEHOLDER => Yii::t('app', 'Last name'),
        REQUIRED => REQUIRED,
        STR_CLASS => INPUT,
        TABINDEX => '1',
        'title' => Yii::t('app', 'Last name is required!'),
        'x-moz-errormessage' => Yii::t('app', 'Last name is required!'),
    ]
)->label(false);


echo $form->field(
    $model,
    SignupForm::USERNAME,
    [
        OPTIONS => [ICON_LEFT => 'fa-user-tie', ICON_RIGHT => ''],
    ]
)->textInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        PLACEHOLDER => Yii::t('app', ' User account'),
        STR_CLASS => INPUT,
        TABINDEX => '2'
    ]
)->label(false);


echo $form->field(
    $model,
    SignupForm::PASSW0RD,
    [
        OPTIONS => [ICON_LEFT => 'fa-lock', ICON_RIGHT => ''],
    ]
)->passwordInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        AUTOCOMPLETE => SignupForm::PASSW0RD,
        PLACEHOLDER => Yii::t('app', ' Password'),
        TABINDEX => '3',
        STR_CLASS => INPUT,
    ]
)->label(false);


echo $form->field(
    $model,
    SignupForm::EMAIL,
    [
        OPTIONS => [ICON_LEFT => 'fa-envelope', ICON_RIGHT => ''],
    ]
)->textInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        PLACEHOLDER => Yii::t('app', ' valid email account, Ex: account@domain.com'),
        STR_CLASS => INPUT,
        TABINDEX => '4',
    ]
)->label(false);

echo '<br><div class="block">',
Html::submitButton(
    Yii::t(
        'app',
        'Signup'
    ),
    [
        AUTOFOCUS => AUTOFOCUS,
        'name' => 'signup-button',
        STR_CLASS => 'button is-primary',
        TABINDEX => '5',
    ]
),
$form->errorSummary($model, array(STR_CLASS => "error-summary")),
'</div>';

ActiveForm::end();

$footer = Yii::$app->view->render('@app/views/partials/_links_return_to');
$uiComponent->cardFooter($footer);

echo '                 
        </div>
    </div>
</div>';

