<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

// kartik widgets
use kartik\select2\Select2;
use kartik\date\DatePicker;

// models
use backend\models\JenisKelaminSearch;
use backend\models\AgamaSearch;
use backend\models\ProdiSearch;
use backend\models\PendidikanTerakhirSearch;
use backend\models\StatusDosenSearch;
use backend\models\UniversitasSearch;

/* @var $this yii\web\View */
/* @var $model backend\models\Dosen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dosen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nidn_nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'jenis_kelamin_id')->widget(Select2::class, [
        'data' => JenisKelaminSearch::list(),
        'options' => ['placeholder' => 'Pilih jenis kelamin...'],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?= $form->field($model, 'tmp_lahir')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'tgl_lahir')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Masukkan tanggal lahir ...'],
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy'
        ],
    ])
    ?>

    <?php
    echo $form->field($model, 'agama_id')->widget(Select2::class, [
        'data' => AgamaSearch::list(),
        'options' => ['placeholder' => 'Pilih agama...'],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?php
    echo $form->field($model, 'homebase_id')->widget(Select2::class, [
        'data' => ProdiSearch::list(),
        'options' => ['placeholder' => 'Pilih prodi...'],
        'hideSearch' => false,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prov_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kab_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kec_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kel_id')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'pendidikan_id')->widget(Select2::class, [
        'data' => PendidikanTerakhirSearch::list(),
        'options' => ['placeholder' => 'Pilih pendidikan terakhir...'],
        'hideSearch' => false,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?php
    echo $form->field($model, 'status_id')->widget(Select2::class, [
        'data' => StatusDosenSearch::list(),
        'options' => ['placeholder' => 'Pilih status dosen...'],
        'hideSearch' => false,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?php
    echo $form->field($model, 'universitas_id')->widget(Select2::class, [
        'data' => UniversitasSearch::list(),
        'options' => ['placeholder' => 'Pilih universitas...'],
        'hideSearch' => false,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?= $form->field($model, 'fakultas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_src')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>