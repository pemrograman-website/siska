<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gedung".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $nama
 */
class Gedung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gedung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 45],
            [['kode', 'nama'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }
}
