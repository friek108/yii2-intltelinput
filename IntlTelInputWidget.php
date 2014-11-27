<?php
/**
 * Created by PhpStorm.
 * User: Huijiewei
 * Date: 2014/11/27
 * Time: 15:53
 */

namespace huijiewei\intltelinput;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\AssetBundle;
use yii\widgets\InputWidget;

class IntlTelInputWidget extends InputWidget
{
    public $options = [];

    public $clientOptions = [];

    /* @var $_assetBundle AssetBundle */
    private $_assetBundle;

    public function init()
    {
        parent::init();

        $this->options = ArrayHelper::merge([
            'class' => 'form-control'
        ], $this->options);

        $this->clientOptions = ArrayHelper::merge([
            'defaultCountry'     => 'auto',
            'numberType'         => 'MOBILE',
            'preferredCountries' => ['cn', 'us'],
            'responsiveDropdown' => true,
        ], $this->clientOptions);

        $this->registerAssetBundle();

        $this->clientOptions['utilsScript'] = $this->_assetBundle->baseUrl . '/lib/libphonenumber/build/utils.js';

        $this->registerScript();
    }

    public function run()
    {
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }

    public function registerScript()
    {
        $clientOptions = Json::encode($this->clientOptions);

        $js = <<<EOD
$('#{$this->options['id']}').intlTelInput({$clientOptions});
EOD;

        $this->getView()->registerJs($js);
    }

    public function registerAssetBundle()
    {
        $this->_assetBundle = IntlTelInputAsset::register($this->getView());
    }

    public function getAssetBundle()
    {
        if (!($this->_assetBundle instanceof AssetBundle)) {
            $this->registerAssetBundle();
        }

        return $this->_assetBundle;
    }
}
