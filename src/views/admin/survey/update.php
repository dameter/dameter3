<?php

/** @var \respund\collector\app\View $this */
/** @var \respund\collector\app\View $this */
/** @var Survey $survey */

use respund\collector\models\Survey;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use respund\collector\app\Translate;

$bundle = \respund\collector\assets\MonacoEditorAsset::register($this);
$code = $survey->structure;
$code = str_replace('\\"', '\\\\"', $code);
$saveUrl = \yii\helpers\Url::toRoute(["//admin/survey/update", 'key' => $survey->key]);

$bundlePath = $bundle->baseUrl;
$this->registerJs(<<<JS
    require.config({ paths: { vs: '$bundlePath/vs' } });
    console.log(document.getElementById('container'));
    console.log('$bundlePath/vs/editor/editor.main');
    require(['vs/editor/editor.main'], function () {
        let formField = document.getElementById('survey-structure');
        var editor = monaco.editor.create(document.getElementById('container'), {
            value: `$code
            `,
            language: 'json'
        });
        
        editor.getModel().onDidChangeContent((event) => {
            formField.value = editor.getValue();
        });
        editor.addCommand(monaco.KeyMod.CtrlCmd | monaco.KeyCode.KeyS, function() {
            //e.preventDefault();
            console.log('SAVE pressed, saving to back-end!');
           $.ajax({
               url: "$saveUrl",
                type: 'POST',
                data: {
                    Survey:{
                        structure: editor.getValue()
                    }, 
                },
               success: function(result) {
                   console.log(result);
               }
            }); 
           
        });
    });
JS
    , $this::POS_END);


?>
<div id="container" style="width:100%;height:90vh;border:1px solid grey"></div>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($survey, 'structure')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton($survey->isNewRecord ? Translate::t('Create') : Translate::t('Update'), ['class' => $survey->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <div><?= Translate::t("Or Ctrl-s on keyboard ...");?></div>
</div>

<?php ActiveForm::end(); ?>
