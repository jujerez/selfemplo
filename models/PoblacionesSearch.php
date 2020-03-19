<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Poblaciones;

/**
 * PoblacionesSearch represents the model behind the search form of `app\models\Poblaciones`.
 */
class PoblacionesSearch extends Poblaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'provincia_id'], 'integer'],
            [['nombre', 'provincia.nombre'], 'safe'],
        ];
    }


    public function attributes()
    {
       return array_merge(parent::attributes(), ['provincia.nombre']);
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
        
        $query = Poblaciones::find()->joinWith('provincia p');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // ORDENACION 
        $dataProvider->sort->attributes['provincia.nombre'] = [
            'asc' => ['p.nombre' => SORT_ASC],
            'desc' => ['p.nombre' => SORT_DESC],
            
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
            'provincia_id' => $this->provincia_id,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
        ->andFilterWhere(['ilike', 'p.nombre', $this->getAttributes(['provincia.nombre'])]);

        return $dataProvider;
    }
}
