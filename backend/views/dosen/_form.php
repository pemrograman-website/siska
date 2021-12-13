<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

// kartik widgets
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;

// models
use backend\models\JenisKelaminSearch;
use backend\models\AgamaSearch;
use backend\models\ProdiSearch;
use backend\models\PendidikanTerakhirSearch;
use backend\models\StatusDosenSearch;
use backend\models\UniversitasSearch;
use backend\models\WilayahSearch;

/* @var $this yii\web\View */
/* @var $model backend\models\Dosen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dosen-form">
    <?php var_dump(Html::getInputId($model, 'prov_id'));
    ?>

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

    <!-- Dropdown provinsi -->
    <?php
    echo $form->field($model, 'prov_id')->widget(Select2::class, [
        'data' => WilayahSearch::provinsiList(),
        'options' => ['placeholder' => 'Pilih provinsi...'],
        'hideSearch' => false,
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <!-- Dependent Dropdown untuk Kab, Kec, dan Kel -->
    <?php
    $kabupatenList = [];
    if (isset($model->prov_id)) {
        $kabupatenList = ArrayHelper::map(WilayahSearch::kabupatenList($model->prov_id), 'kode', 'nama');
    }

    echo $form->field($model, 'kab_id')->widget(DepDrop::class, [
        'data' => $kabupatenList,
        'options' => ['placeholder' => 'Pilih kabupaten...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => [
                Html::getInputId($model, 'prov_id')
            ],
            'url' => Url::to(['wilayah/kabupaten']),             // ajax
            'loadingText' => 'Memuat kab/kota...',
        ]
    ]);

    $kecamatanList = [];
    if (isset($model->kab_id)) {
        $kecamatanList = ArrayHelper::map(WilayahSearch::kecamatanList($model->kab_id), 'kode', 'nama');
    }

    echo $form->field($model, 'kec_id')->widget(DepDrop::class, [
        'data' => $kecamatanList,
        'options' => ['placeholder' => 'Pilih kecamatan...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => [
                Html::getInputId($model, 'prov_id'),
                Html::getInputId($model, 'kab_id')
            ],
            'url' => Url::to(['wilayah/kecamatan']),             // ajax
            'loadingText' => 'Memuat kecamatan...',
        ]
    ]);

    $kelurahanList = [];
    if (isset($model->_id)) {
        $kelurahanList = ArrayHelper::map(WilayahSearch::kelurahanList($model->prov_id), 'kode', 'nama');
    }

    echo $form->field($model, 'kel_id')->widget(DepDrop::class, [
        'data' => $kelurahanList,
        'options' => ['placeholder' => 'Pilih kelurahan..'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => [
                Html::getInputId($model, 'prov_id'),
                Html::getInputId($model, 'kab_id'),
                Html::getInputId($model, 'kec_id')
            ],
            'initialize' => true,
            'initDepends' => [
                Html::getInputId($model, 'prov_id')
            ],
            'url' => Url::to(['wilayah/kelurahan']),             // ajax
            'loadingText' => 'Memuat kelurahan...',
        ]
    ]);
    ?>

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

    <?= $form->field($model, 'fakultas_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi_asal')->textInput(['maxlength' => true]) ?>

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