<?php

/** @var \respund\collector\app\View $this */
/** @var \respund\collector\models\SurveySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

use respund\collector\models\Survey;

?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pager' => [
        'class' => \yii\bootstrap5\LinkPager::class
    ],
    'columns' => [

        'key',
        'name',
        'uuid',
        'time_created:datetime',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => "{view} {update}",
            'urlCreator' => function ($action, Survey $model, $key, $index) {
                return \yii\helpers\Url::to(["//admin/survey/$action", "key" => $model->key]);
            }
        ],
    ],
]); ?>
