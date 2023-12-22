<?php

/** @var \respund\collector\app\View $this */
/** @var \respund\collector\models\RespondentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

use respund\collector\models\Respondent;


?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pager' => [
        'class' => \yii\bootstrap5\LinkPager::class
    ],
    'columns' => [

        'key',
        'uuid',
        'time_created:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => "{view} {update}",
            'urlCreator' => function ($action, Respondent $model, $key, $index) {
                return \yii\helpers\Url::to(["//admin/respondent/$action", "key" => $model->key]);
            }
        ],
    ],
]); ?>
