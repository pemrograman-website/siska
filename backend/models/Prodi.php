<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property int $prodi_id
 * @property string|null $kode
 * @property string|null $nama
 * @property int $fakultas_id
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prodi_id', 'fakultas_id'], 'required'],
            [['prodi_id', 'fakultas_id'], 'integer'],
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 50],
            [['prodi_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prodi_id' => 'Prodi ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'fakultas_id' => 'Fakultas ID',
        ];
    }
}
