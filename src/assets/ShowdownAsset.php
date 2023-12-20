<?php
declare(strict_types=1);

namespace respund\collector\assets;

use yii\web\AssetBundle;

class ShowdownAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@npm/showdown/dist';

    /**
     * @var string[]
     */
    public $js = [
        'showdown.min.js',
    ];

}
