<?php
declare(strict_types=1);

namespace respund\collector\controllers\admin;

use respund\collector\models\Respondent;
use respund\collector\models\RespondentSearch;

class RespondentController extends BaseAdminModelController
{

    protected $modelClass = Respondent::class;
    protected $searchModelClass = RespondentSearch::class;

}