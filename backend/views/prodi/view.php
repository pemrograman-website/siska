<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Prodi */
?>
<div class="prodi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'prodi_id',
            'kode',
            'nama',
            'fakultas_id',
        ],
    ]) ?>

</div>
