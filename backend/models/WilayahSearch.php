<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use backend\models\Wilayah;
use yii\db\Query;

/**
 * WilayahSearch represents the model behind the search form about `backend\models\Wilayah`.
 */
class WilayahSearch extends Wilayah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'safe'],
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
        $query = Wilayah::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }

    /*
        Fungsi untuk menampilkan daftar provinsi untuk dropdown    
    */

    public static function provinsiList()
    {

        $query = new Query();

        $query->from('wilayah');
        $query->where('CHAR_LENGTH(kode)=2');
        $query->orderBy([
            'kode' => SORT_ASC,
        ]);

        $list = $query->all();

        return ArrayHelper::map($list, 'kode', 'nama');
    }

    /*
        Fungsi untuk menampilkan daftar kabupaten untuk dropdown    
    */

    public static function kabupatenList($id)
    {
        $query = new Query();

        $query->from('wilayah');
        $query->where('CHAR_LENGTH(kode)=5 AND kode LIKE "' . $id . '.__"');
        $query->orderBy([
            'kode' => SORT_ASC,
        ]);

        $list = $query->all();

        return $list;
    }

    /*
        Fungsi untuk menampilkan daftar kecamatan untuk dropdown    
    */

    public static function kecamatanList($id)
    {
        $query = new Query();

        $query->from('wilayah');
        $query->where('CHAR_LENGTH(kode)=8 AND kode LIKE "' . $id . '.__"');
        $query->orderBy([
            'kode' => SORT_ASC,
        ]);

        $list = $query->all();

        return $list;
    }

    /*
        Fungsi untuk menampilkan daftar kelurahan untuk dropdown    
    */

    public static function kelurahanList($id)
    {
        $query = new Query();

        $query->from('wilayah');
        $query->where('CHAR_LENGTH(kode)=13 AND kode LIKE "' . $id . '.____"');
        $query->orderBy([
            'kode' => SORT_ASC,
        ]);

        $list = $query->all();

        return $list;
    }
}
