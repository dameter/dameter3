<?php
declare(strict_types=1);

namespace respund\collector\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MonacoEditorAsset extends AssetBundle
{

    /**
     * @var string
     */
    public $sourcePath = '@npm/monaco-editor/min/';


    /**
     * @var string[]
     */
    public $js = [
        'vs/loader.js',
    ];


}
