<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $id
 * @property string|null $nidn_nip
 * @property string|null $nama_lengkap
 * @property int|null $jenis_kelamin_id
 * @property string|null $tmp_lahir
 * @property string|null $tgl_lahir
 * @property string|null $agama_id
 * @property int|null $homebase_id
 * @property string|null $no_hp
 * @property string|null $alamat
 * @property string|null $prov_id
 * @property string|null $kab_id
 * @property string|null $kec_id
 * @property string|null $kel_id
 * @property int|null $pendidikan_id
 * @property int|null $status_id
 * @property int|null $universitas_id
 * @property string|null $fakultas
 * @property string|null $prodi
 * @property string|null $foto_src
 * @property string $foto_web
 * @property int $user_id
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_kelamin_id', 'homebase_id', 'pendidikan_id', 'status_id', 'universitas_id', 'user_id'], 'integer'],
            [['tgl_lahir'], 'safe'],
            [['user_id'], 'required'],
            [['nidn_nip'], 'string', 'max' => 10],
            [['nama_lengkap'], 'string', 'max' => 50],
            [['tmp_lahir'], 'string', 'max' => 30],
            [['agama_id', 'fakultas', 'prodi'], 'string', 'max' => 45],
            [['no_hp'], 'string', 'max' => 15],
            [['alamat', 'foto_src'], 'string', 'max' => 100],
            [['prov_id'], 'string', 'max' => 2],
            [['kab_id'], 'string', 'max' => 5],
            [['kec_id'], 'string', 'max' => 8],
            [['kel_id'], 'string', 'max' => 13],
            [['foto_web'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nidn_nip' => 'NIDN/NIP',
            'nama_lengkap' => 'Nama Lengkap',
            'jenis_kelamin_id' => 'Jenis Kelamin',
            'tmp_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'agama_id' => 'Agama',
            'homebase_id' => 'Homebase',
            'no_hp' => 'No HP',
            'alamat' => 'Alamat',
            'prov_id' => 'Provinsi',
            'kab_id' => 'Kabupaten',
            'kec_id' => 'Kecamatan',
            'kel_id' => 'Kelurahan',
            'pendidikan_id' => 'Pendidikan Terakhir',
            'status_id' => 'Status Dosen',
            'universitas_id' => 'Universitas',
            'fakultas' => 'Fakultas',
            'prodi' => 'Program Studi',
            'foto_src' => 'Foto Src',
            'foto_web' => 'Foto Web',
            'user_id' => 'User ID',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->tgl_lahir = strtotime($this->tgl_lahir);
            $this->tgl_lahir = date('Y-m-d', $this->tgl_lahir);

            return true;
        }

        return false;
    }

    public function afterFind()
    {
        $this->tgl_lahir = strtotime($this->tgl_lahir);
        $this->tgl_lahir = date('d-m-Y', $this->tgl_lahir);

        parent::afterFind();
    }
}
