<?php
declare(strict_types=1);

namespace respund\collector\controllers;

use respund\collector\traits\ApplicationAwareTrait;
use respund\collector\traits\WebControllerTrait;
use respund\collector\traits\WebModelControllerTrait;
use yii\web\Controller;

class BaseController extends Controller
{
    use ApplicationAwareTrait;
    use WebControllerTrait;
    use WebModelControllerTrait;

    /**
     * @var array<string, mixed>
     */
    protected array $viewParams = [];

}