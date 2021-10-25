<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\JenisKelamin */
?>
<div class="jenis-kelamin-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
        ],
    ]) ?>

</div>
