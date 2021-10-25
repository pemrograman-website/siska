<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StatusDosen */
?>
<div class="status-dosen-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
        ],
    ]) ?>

</div>
