<?php

use app\components\UiComponent;
use app\models\forms\PasswordResetRequestForm;
use app\models\queries\Bitacora;
use yii\bootstrap4\Button;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var yii\widgets\ActiveForm $form */
/* @var PasswordResetRequestForm $model */

$this->title = Yii::t('app', 'Request password reset');
$this->params[BREADCRUMBS][] = $this->title;

echo '
<div class="row ">
    <div class="col-sm-3"> &nbsp; </div>
    <div class="col-sm-6">';

$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    'fas fa-envelope',
    'card-header-background-gray',
    $this->title,
    '',
    '000'
);

echo ' <p class="text-justify help-block">',
Yii::t(
    'app',
    'Please, write your registered mail in this platform to reset your password'
),
'</p>';

$form = ActiveForm::begin(
    [
    'id' => 'request-password-reset-form',
    'fieldClass' => 'app\widgets\ActiveFieldForm',
    ]
);

echo $form->field(
    $model,
    PasswordResetRequestForm::EMAIL,
    [
        'options' => ['icon-left' => 'fa-envelope', 'icon-right' => ' '],
    ]
)->textInput(
    [
        'placeholder' => Yii::t(
            'app',
            ' valid email account, Ex: account@domain.com'
        ),
        STR_CLASS => ' form-control  ',
        REQUIRED => REQUIRED,
        TITLE => Yii::t('app', 'Email is required information!'),
        'x-moz-errormessage' => Yii::t('app', 'Email is required information!')
    ]
)->label(false);

echo '<div class="block">
                    <div class=" text-justify  help-block">';

echo Yii::t(
    'app',
    'A link to reset the password will be sent to your email account.'
);

echo '
                </div><br>';
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
    $bitacora->register($exception, 'app\views\password::Button::widget', MSG_ERROR);
}

echo '&nbsp;
            </div>';

ActiveForm::end();

$footer = Yii::$app->view->render('@app/views/partials/_links_return_to');

$uiComponent->cardFooter($footer);

echo '               
        </div>
        <div class="col-sm-3"> &nbsp; </div>
    </div>
</div>';
