<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Presupuestos;

/**
 * PresupuestosSearch represents the model behind the search form of `app\models\Presupuestos`.
 */
class PresupuestosSearch extends Presupuestos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profesional_id', 'empleo_id'], 'integer'],
            [['precio'], 'number'],
            [['detalles'], 'string'],
            [['duracion_estimada'], 'number'],
            [['estado'], 'string'],
            [['profesional.profesionales.nombre'], 'safe'],
            [['empleo.titulo'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), 
        ['profesional.profesionales.nombre', 'empleo.titulo']);
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
        $query = Presupuestos::find()
        ->joinWith('profesional.profesionales p')
        ->joinWith('empleo e');


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // ORDENACION
        $dataProvider->sort->attributes['profesional.profesionales.nombre'] = [
            'asc' => ['p.nombre' => SORT_ASC],
            'desc' => ['p.nombre' => SORT_DESC],
            
        ];

        $dataProvider->sort->attributes['empleo.titulo'] = [
            'asc' => ['e.titulo' => SORT_ASC],
            'desc' => ['e.titulo' => SORT_DESC],
            
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
            'precio' => $this->precio,
            'estado' => $this->estado,
            'detalles' => $this->detalles,
            'duracion_estimada' => $this->duracion_estimada,
            'profesional_id' => $this->profesional_id,
            'empleo_id' => $this->empleo_id,
        ]);

        $query->andFilterWhere(['ilike', 'detalles', $this->detalles])
        ->andFilterWhere(['ilike', 'p.nombre', $this->getAttributes(['profesional.profesionales.nombre'])])
        ->andFilterWhere(['ilike', 'e.titulo', $this->getAttributes(['empleo.titulo'])]);

        return $dataProvider;
    }
}
