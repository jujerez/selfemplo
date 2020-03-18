<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profesiones;

/**
 * ProfesionesSearch represents the model behind the search form of `app\models\Profesiones`.
 */
class ProfesionesSearch extends Profesiones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sector_id'], 'integer'],
            [['pronom', 'sector.secnom'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), 
        ['sector.secnom',]);
    }

    /**
     * {@inheritdoc}
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
        //$query = Profesiones::find();
        $query = Profesiones::find()
        ->joinWith('sector s');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // ORDENACION 
        $dataProvider->sort->attributes['sector.secnom'] = [
            'asc' => ['s.secnom' => SORT_ASC],
            'desc' => ['s.secnom' => SORT_DESC],
            
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sector_id' => $this->sector_id,
        ]);

        $query->andFilterWhere(['ilike', 'pronom', $this->pronom])
        ->andFilterWhere(['ilike', 's.secnom', $this->getAttributes(['sector.secnom'])]);

        return $dataProvider;
    }
}
