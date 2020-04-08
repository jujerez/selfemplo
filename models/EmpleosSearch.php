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
                    'empleador.empleadores.nombre',
                    'poblacion.provincia.nombre',
                    'profesion.sector.secnom'
                ]
              , 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), 
        ['profesion.pronom', 'poblacion.nombre', 'empleador.nombre','poblacion.provincia.nombre','profesion.sector.secnom', 'empleador.empleadores.nombre']);
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
        $query = Empleos::find()->alias('emple')
          ->joinWith('poblacion p')
          ->joinWith('profesion pro')
          ->joinWith('empleador e')
          ->joinWith('empleador.empleadores emp')
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
            'label' => 'Población',
        ];

        $dataProvider->sort->attributes['profesion.pronom'] = [
            'asc' => ['pro.pronom' => SORT_ASC],
            'desc' => ['pro.pronom' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['empleador.nombre'] = [
            'asc' => ['e.nombre' => SORT_ASC],
            'desc' => ['e.nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['profesion.sector.secnom'] = [
            'asc' => ['s.secnom' => SORT_ASC],
            'desc' => ['s.secnom' => SORT_DESC],
            'label' => 'Sector',
        ];

        $dataProvider->sort->attributes['poblacion.provincia.nombre'] = [
            'asc' => ['prov.nombre' => SORT_ASC],
            'desc' => ['prov.nombre' => SORT_DESC],
            'label' => 'Provincia',
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
            //'empleador_id' => $this->empleador_id,
            'profesion_id' => $this->profesion_id,
        ]);

          $formateada = '';
          if ($this->created_at != '') {
            $formateada = date('Y-m-d H:i:s', strtotime($this->created_at));
          }

      
        
    
        $query->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'p.nombre', $this->getAttributes(['poblacion.nombre'])])
            ->andFilterWhere(['ilike', 'pro.pronom', $this->getAttributes(['profesion.pronom'])])
            ->andFilterWhere(['ilike', 'e.nombre', $this->getAttributes(['empleador.nombre'])])
            ->andFilterWhere(['ilike', 'emp.nombre', $this->getAttributes(['empleador.empleadores.nombre'])])
            ->andFilterWhere(['ilike', 'prov.nombre', $this->getAttributes(['poblacion.provincia.nombre'])])
            ->andFilterWhere(['ilike', 's.secnom', $this->getAttributes(['profesion.sector.secnom'])])
            ->andFilterWhere(['between', 'emple.created_at',$formateada, date('Y-m-d H:i:s',strtotime($this->created_at)+ 3600*24-1)]);

        return $dataProvider;
    }
}
