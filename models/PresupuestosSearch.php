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
            [['duracion_estimada'], 'safe'],
            [['estado'], 'string'],
        ];
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
        $query = Presupuestos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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
            'profesional_id' => $this->profesional_id,
            'empleo_id' => $this->empleo_id,
        ]);

        $query->andFilterWhere(['ilike', 'duracion_estimada', $this->duracion_estimada]);

        return $dataProvider;
    }
}
