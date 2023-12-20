<?php
use yii\helpers\Html;

/** @var \respund\collector\app\View $this */

?>

<meta charset="<?= \Yii::$app->charset ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
<link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
<?php $this->head();?>
