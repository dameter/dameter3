<?php

/** @var \respund\collector\app\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception  */
/** @var string $retryUrl */

use respund\collector\app\Translate;
?>
<div class="jumbotron">
    <div class="alert alert-danger">
        <h1><?= Translate::t("Denied")?></h1>
    </div>
    <div class="container">
        <?= \yii\helpers\Html::a(Translate::t("Try again"), $retryUrl, ['class' => 'btn btn-primary'])?>
    </div>

    <div><?= $this->request()->getUserIP() ?></div>
</div>
