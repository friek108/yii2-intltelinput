<?php
/**
 * Created by PhpStorm.
 * User: Huijiewei
 * Date: 2014/11/27
 * Time: 15:49
 */

namespace huijiewei\intltelinput;

use yii\web\AssetBundle;

class IntlTelInputAsset extends AssetBundle
{
    public $sourcePath = '@bower/intl-tel-input/assets';

    public $css = [
        'build/css/intlTelInput.css'
    ];

    public $js = [
        'build/js/intlTelInput.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
