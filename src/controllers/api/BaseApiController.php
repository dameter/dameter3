<?php
declare(strict_types=1);

namespace respund\collector\controllers\api;


use respund\collector\traits\ApplicationAwareTrait;
use respund\collector\traits\WebControllerTrait;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\filters\auth\CompositeAuth;
use yii\web\Response;

class BaseApiController extends Controller
{
    use ApplicationAwareTrait;
    use WebControllerTrait;

    /**
     * @return array<string, mixed>
     */
    public function behaviors() : array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                //'application/xml' => Response::FORMAT_XML,
            ],
        ];

        return $behaviors;
    }

    /**
     * @return array<string, mixed>
     */
    protected function logContext() : array
    {
        return [
            'module' =>'api',
            'controller' => static::class,
            'action' => $this->action->id,
        ];
    }



}
