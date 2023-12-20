<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception  */
/** @var string $retryUrl */

use respund\collector\Translate;
var_dump($retryUrl);
?>
<div class="jumbotron">
    <div class="alert alert-danger">
        <h1><?= Translate::t("Denied")?></h1>
    </div>
    <div class="container">
        <?= \yii\helpers\Html::a(Translate::t("Try again"), $retryUrl, ['class' => 'btn btn-primary'])?>
    </div>

    <div><?= Yii::$app->request->getUserIP() ?></div>
</div>
