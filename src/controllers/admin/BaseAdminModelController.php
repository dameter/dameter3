<?php
declare(strict_types=1);

namespace respund\collector\controllers\admin;

use app\contracts\SearchableAccountable;
use respund\collector\controllers\BaseController;
use respund\collector\models\ActiveRecord;
use respund\collector\models\SearchInterface;
use respund\collector\Translate;
use Yii;
use yii\base\UserException;
use yii\filters\AccessControl;

class BaseAdminModelController extends BaseAdminController
{
    /** @var string  */
    protected $modelClass = "";

    /** @var string  */
    protected $searchModelClass = "";

    public function actionIndex() : string
    {
        /** @var SearchInterface $searchModel */
        $searchModel = new $this->searchModelClass;

        $dataProvider = $searchModel->search($this->request()->queryParams);
        $this->viewParams['searchModel'] = $searchModel;
        $this->viewParams['dataProvider'] = $dataProvider;

        return $this->render('index', $this->viewParams);

    }

}