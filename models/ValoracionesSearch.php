<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Valoraciones;

/**
 * ValoracionesSearch represents the model behind the search form of `app\models\Valoraciones`.
 */
class ValoracionesSearch extends Valoraciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empleador_id', 'profesional_id', 'presupuesto_id'], 'integer'],
            [['voto'], 'number'],
            [['comentario', 'created_at'], 'safe'],
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
        $query = Valoraciones::find();

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
            'voto' => $this->voto,
            'created_at' => $this->created_at,
            'empleador_id' => $this->empleador_id,
            'profesional_id' => $this->profesional_id,
            'presupuesto_id' => $this->presupuesto_id,
        ]);

        $query->andFilterWhere(['ilike', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
