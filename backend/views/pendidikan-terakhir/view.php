<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PendidikanTerakhir */
?>
<div class="pendidikan-terakhir-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
        ],
    ]) ?>

</div>
