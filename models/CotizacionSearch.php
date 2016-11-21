<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cotizacion;

/**
 * CotizacionSearch represents the model behind the search form about `app\models\Cotizacion`.
 */
class CotizacionSearch extends Cotizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'iva'], 'integer'],
            [['vendedor', 'cliente', 'ruc', 'entrega', 'fecha_cotizacion', 'fecha_limite'], 'safe'],
            [['descuento'], 'number'],
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
        $query = Cotizacion::find();

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
            'iva' => $this->iva,
            'fecha_cotizacion' => $this->fecha_cotizacion,
            'fecha_limite' => $this->fecha_limite,
            'descuento' => $this->descuento,
        ]);

        $query->andFilterWhere(['like', 'vendedor', $this->vendedor])
            ->andFilterWhere(['like', 'cliente', $this->cliente])
            ->andFilterWhere(['like', 'ruc', $this->ruc])
            ->andFilterWhere(['like', 'entrega', $this->entrega]);

        return $dataProvider;
    }
}
