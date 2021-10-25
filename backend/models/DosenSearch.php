<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dosen;

/**
 * DosenSearch represents the model behind the search form about `backend\models\Dosen`.
 */
class DosenSearch extends Dosen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'homebase_id', 'status_id', 'universitas_id', 'user_id'], 'integer'],
            [['nidn_nip', 'nama_lengkap', 'jenis_kelamin_id', 'tmp_lahir', 'tgl_lahir', 'agama_id', 'no_hp', 'alamat', 'prov_id', 'kab_id', 'kec_id', 'kel_id', 'pendidikan_id', 'fakultas', 'prodi', 'foto_src', 'foto_web'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Dosen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tgl_lahir' => $this->tgl_lahir,
            'homebase_id' => $this->homebase_id,
            'status_id' => $this->status_id,
            'universitas_id' => $this->universitas_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nidn_nip', $this->nidn_nip])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'jenis_kelamin_id', $this->jenis_kelamin_id])
            ->andFilterWhere(['like', 'tmp_lahir', $this->tmp_lahir])
            ->andFilterWhere(['like', 'agama_id', $this->agama_id])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'prov_id', $this->prov_id])
            ->andFilterWhere(['like', 'kab_id', $this->kab_id])
            ->andFilterWhere(['like', 'kec_id', $this->kec_id])
            ->andFilterWhere(['like', 'kel_id', $this->kel_id])
            ->andFilterWhere(['like', 'pendidikan_id', $this->pendidikan_id])
            ->andFilterWhere(['like', 'fakultas', $this->fakultas])
            ->andFilterWhere(['like', 'prodi', $this->prodi])
            ->andFilterWhere(['like', 'foto_src', $this->foto_src])
            ->andFilterWhere(['like', 'foto_web', $this->foto_web]);

        return $dataProvider;
    }
}
