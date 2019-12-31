<?php

namespace app\widgets;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

class ActiveFieldForm extends ActiveField
{

    public function init()
    {
        $iconLeft  = ArrayHelper::getValue($this->options,'icon-left' ,'');
        $iconRight = ArrayHelper::getValue($this->options,'icon-right' ,'');

        if (isset($iconLeft[3])) { // String is greather than 3 chars
            $iconLeft = '<div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas '.$iconLeft.'"></i></span>
                        </div>';
        }
        if (isset($iconRight[3])) {
            $iconRight = '<div class="input-group-append">
                                <span class="input-group-text"><i class="fas '.$iconRight .'"></i></span>
                          </div>';
        }

        $this->template ='
                <div class="input-group mb-3">
                    <label class="control-label">
                        {label}
                    </label>
                    '.$iconLeft.'
                    {input}
                     '. $iconRight.'
                    <div class="input-group alert-danger bg-white" role="alert">
                        {error}
                    </div>
                    {hint}
                </div>';

        parent::init();
    }
}
