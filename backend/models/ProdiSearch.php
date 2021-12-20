<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

// models
use backend\models\Prodi;

/**
 * ProdiSearch represents the model behind the search form about `backend\models\Prodi`.
 */
class ProdiSearch extends Prodi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fakultas_id'], 'integer'],
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
        $query = Prodi::find();

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
            'fakultas_id' => $this->fakultas_id,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }

    // Mengembalikan daftar prodi untuk Select2
    public static function list()
    {
        $list = Prodi::find()->all();

        return ArrayHelper::map($list, 'id', 'nama');
    }
}
