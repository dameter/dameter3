<?php
declare(strict_types=1);

namespace respund\collector\controllers\admin;

use respund\collector\controllers\BaseController;
use respund\collector\Translate;
use Yii;
use yii\base\UserException;
use yii\filters\AccessControl;

class BaseAdminController extends BaseController
{
    public $layout = "admin";

    /**
     * @return array<mixed>
     */
    public function behaviors() : array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'ips' => Yii::$app->params['adminIps'] ??['*'],
                    ],
                ],
                'denyCallback' => function() {
                    throw new UserException(Translate::t('Denied!'));
                }
            ],
        ];
    }

}