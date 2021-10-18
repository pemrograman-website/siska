<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use backend\models\Fakultas;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Prodi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prodi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?php

    $data = Fakultas::fakultasList();           // Array daftar fakultas: id => nama

    echo $form->field($model, 'fakultas_id')->widget(Select2::className(), [
        'data' => $data,
        // 'theme' => Select2::THEME_KRAJEE, // this is the default if theme is not set
        'options' => ['placeholder' => 'Pilih fakultas...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>