<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empleos;

/**
 * EmpleosSearch represents the model behind the search form of `app\models\Empleos`.
 */
class EmpleosSearch extends Empleos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'poblacion_id', 'empleador_id', 'profesion_id'], 'integer'],
            [
                [
                    'titulo', 
                    'descripcion', 
                    'created_at', 
                    'profesion.pronom', 
                    'poblacion.nombre', 
                    'empleador.nombre', 
                    'poblacion.provincia.nombre',
                    'profesion.sector.secnom'
                ]
              , 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), 
        ['profesion.pronom', 'poblacion.nombre', 'empleador.nombre','poblacion.provincia.nombre','profesion.sector.secnom']);
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
        $query = Empleos::find();
        $query = Empleos::find()
          ->joinWith('poblacion p')
          ->joinWith('profesion pro')
          ->joinWith('empleador e')
          ->joinWith('provincia prov')
          ->joinWith('sector s');
          
          

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // ORDENACION 
        $dataProvider->sort->attributes['poblacion.nombre'] = [
            'asc' => ['p.nombre' => SORT_ASC],
            'desc' => ['p.nombre' => SORT_DESC],
        ];

        

        $dataProvider->sort->attributes['profesion.pronom'] = [
            'asc' => ['pro.pronom' => SORT_ASC],
            'desc' => ['pro.pronom' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['empleador.nombre'] = [
            'asc' => ['e.nombre' => SORT_ASC],
            'desc' => ['e.nombre' => SORT_DESC],
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
            'created_at' => $this->created_at,
            'poblacion_id' => $this->poblacion_id,
            'empleador_id' => $this->empleador_id,
            'profesion_id' => $this->profesion_id,
        ]);


        $query->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'p.nombre', $this->getAttributes(['poblacion.nombre'])])
            ->andFilterWhere(['ilike', 'pro.pronom', $this->getAttributes(['profesion.pronom'])])
            ->andFilterWhere(['ilike', 'e.nombre', $this->getAttributes(['empleador.nombre'])])
            ->andFilterWhere(['ilike', 'prov.nombre', $this->getAttributes(['poblacion.provincia.nombre'])])
            ->andFilterWhere(['ilike', 's.secnom', $this->getAttributes(['profesion.sector.secnom'])]);

        return $dataProvider;
    }
}
