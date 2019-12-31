<?php

if (YII_ENV) {
    $bundles = [
        'yii\web\JqueryAsset' => [
            'js' => ['jquery.js']
        ],
        'yii\bootstrap4\BootstrapAsset' => [
            'css' => ['css/bootstrap.css']
        ],
        'yii\bootstrap4\BootstrapPluginAsset' => [
            'js' => ['js/bootstrap.js']
        ]
    ];
} else {
    $bundles = [
        'yii\web\JqueryAsset' => [
            'js' => ['jquery.min.js']
        ],
        'yii\bootstrap4\BootstrapAsset' => [
            'css' => ['css/bootstrap.min.css'],
        ],
        'yii\bootstrap4\BootstrapPluginAsset' => [
            'js' => ['js/bootstrap.min.js']
        ]
    ];
}

return $bundles;
