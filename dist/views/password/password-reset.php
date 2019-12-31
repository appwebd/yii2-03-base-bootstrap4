<?php
/**
 * Password reset (input new password)
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Password
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */

use app\components\UiComponent;
use app\models\forms\PasswordResetForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var object $model \app\models\forms\PasswordResetForm */

$this->title = Yii::t('app', 'Password reset');
$this->params[BREADCRUMBS][] = $this->title;

echo '
<div class="container ">
    <div class="row">
        <div class="col-sm-3 "> &nbsp; </div>
        <div class="col-sm-6  webpage ">';


        $uiComponent = new UiComponent();
        $uiComponent->cardHeader(
            'lock',
            'color-red',
            $this->title,
            Yii::t(
                'app',
                'Please, write your new password'
            ),
            '000'
        );


        $form = ActiveForm::begin(
            [
                'id' => 'request-password-reset-form',
                'fieldClass' => 'app\widgets\ActiveFieldForm',
                'options' => ['class' => 'form-horizontal webpage'],
            ]
        );

        echo $form->field($model, PasswordResetForm::USER_ID)->hiddenInput(
            [
                VALUE => $model->user_id,
            ]
        )->label(false);

        echo $form->field(
            $model,
            PasswordResetForm::PASSW0RD,
            [
                'options' => ['icon-left' => 'fa-lock', 'icon-right' => ''],
            ]
        )->passwordInput(
            [
                'id' => 'passwd',
                'placeholder' => Yii::t(
                    'app',
                    'New password, Minimum password length are 8 chars and max. 50.'
                )
            ]
        )->label(false);

        echo '<input type="checkbox" onclick="showPassword()">&nbsp;&nbsp;',
        Yii::t('app', 'show password');

        echo '<br/><br/><br/>';

        echo Html::submitButton(
            Yii::t('app', 'Submit'),
            ['class' => 'btn btn-primary']
        );
        echo '<br/><br/><br/>';

ActiveForm::end();

$footer = Yii::$app->view->render('@app/views/partials/_links_return_to');
$uiComponent->cardFooter($footer);

echo '  </div> <!-- col-sm-6 -->
        <div class="col-sm-3 "> &nbsp;&nbsp; </div>

    </div> <!-- row -->
</div>'; // container

$script = <<< JS
                function showPassword() {
                    var object = document.getElementById("passwd");
                    if (object.type === "password") {
                        object.type = "text";
                    } else {
                        object.type = "password";
                    }
                }
JS;

$this->registerJs($script, View::POS_HEAD);
