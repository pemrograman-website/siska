<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Wilayah */
?>
<div class="wilayah-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode',
            'nama',
        ],
    ]) ?>

</div>
