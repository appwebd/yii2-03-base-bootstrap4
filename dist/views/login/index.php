<?php
/**
 * Login
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Login
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */

use app\components\UiComponent;
use app\models\forms\LoginForm;
use app\models\queries\Bitacora;
use yii\bootstrap4\Button;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var yii\widgets\ActiveForm $form */
/* @var LoginForm $model */

$this->title = Yii::t('app', 'Login');
$this->params[BREADCRUMBS][] = $this->title;

echo '

    <div class="row">
        <div class="col-sm-2"> &nbsp; </div>
        <div class="col-sm-8">';

$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    'fas fa-user ',
    ' card-header-background-login is-white ',
    $this->title,
    Yii::t(
        'app',
        'Please complete the following fields to start your session:'
    ),
    '000'
);

$form = ActiveForm::begin(
    [
        'id' => 'login-form',
        'fieldClass' => app\widgets\ActiveFieldForm::class,
    ]
);

echo $form->field(
    $model,
    'username',
    [
        OPTIONS => ['icon-left' => 'fa-envelope', 'icon-right' => ' '],
    ]
)->textInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        AUTOCOMPLETE => 'off',
        TABINDEX => '1',
        PLACEHOLDER => Yii::t('app', 'User account'),
        REQUIRED => 'required',
        STR_CLASS => ' form-control  ',
        TITLE => 'The user account is required information!',
        'x-moz-errormessage' => 'The user account is required information!'
    ]
)->label(false);

echo BREAK_LINE;
echo $form->field(
    $model,
    'password',
    [
        'options' => ['icon-left' => 'fa-lock', 'icon-right' => ''],
    ]
)->passwordInput(
    [
        AUTOFOCUS => AUTOFOCUS,
        AUTOCOMPLETE => 'off',
        PLACEHOLDER => Yii::t('app', 'Password'),
        REQUIRED => 'required',
        STR_CLASS => ' form-control  ',
        TABINDEX => '2',
        TITLE => Yii::t(
            'app',
            'The password is required information!'
        ),
        'x-moz-errormessage' => Yii::t(
            'app',
            'The password is required information!'
        )
    ]
)->label(false);


echo BREAK_LINE;
echo $form->field($model, 'rememberMe')->checkbox(
    [
        'title' => 'We don\'t recommend this in shared computers.',
        AUTOFOCUS => AUTOFOCUS,
        TABINDEX => '3'
    ]
);

try {
    echo Button::widget(
        [
            'label' => Yii::t('app', 'Submit'),
            'options' => [
                'class' => 'btn btn-primary'
            ],
        ]
    );
} catch (Exception $exception) {
    $bitacora = new Bitacora();
    $bitacora->register(
        $exception,
        'app\views\layouts\main.php Alert::widget',
        MSG_ERROR
    );
}


ActiveForm::end();


$footer = '<div class="text-center">&nbsp;' .
    Html::a(Yii::t('app', 'forget your password?'), Url::to(['/password/index'])) .
    ' &nbsp; | &nbsp;' .
    Yii::t('app', 'You do not have an account?') .
    '&nbsp;' .
    Html::a(Yii::t('app', 'Signup'), Url::to(['/signup/index'])) .
    BREAK_LINE . '</div>';

$uiComponent->cardFooter($footer);


echo '    </div>
          <div class="col-sm-2"> &nbsp; </div>
      </div>';
