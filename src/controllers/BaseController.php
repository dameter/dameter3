<?php
declare(strict_types=1);

namespace respund\collector\controllers;

use respund\collector\traits\ApplicationAwareTrait;
use respund\collector\traits\WebControllerTrait;
use yii\web\Controller;

class BaseController extends Controller
{
    use ApplicationAwareTrait;
    use WebControllerTrait;

    /**
     * @var array<string, mixed>
     */
    protected array $viewParams = [];


}