<?php
namespace respund\collector\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MonacoEditorAsset extends AssetBundle
{

    public $sourcePath = '@npm/monaco-editor/min/';

    public function init() {
//        $this->jsOptions['position'] = View::POS_READY;
        parent::init();

    }

    public $js = [
        'vs/loader.js',
    ];


}
