<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Dosen */
?>
<div class="dosen-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nidn_nip',
            'nama_lengkap',
            'jenis_kelamin_id',
            'tmp_lahir',
            'tgl_lahir',
            'agama_id',
            'homebase_id',
            'no_hp',
            'alamat',
            'prov_id',
            'kab_id',
            'kec_id',
            'kel_id',
            'pendidikan_id',
            'status_id',
            'universitas_id',
            'fakultas',
            'prodi',
            'foto_src',
            'foto_web',
            'user_id',
        ],
    ]) ?>

</div>
