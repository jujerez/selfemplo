<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valoraciones".
 *
 * @property int $id
 * @property float $voto
 * @property string $comentario
 * @property string $created_at
 * @property int $empleador_id
 * @property int $profesional_id
 * @property int $presupuesto_id
 *
 * @property Presupuestos $presupuesto
 * @property Usuarios $empleador
 * @property Usuarios $profesional
 */
class Valoraciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valoraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voto', 'comentario', 'empleador_id', 'profesional_id', 'presupuesto_id'], 'required'],
            [['voto'], 'number'],
            [['created_at'], 'safe'],
            [['empleador_id', 'profesional_id', 'presupuesto_id'], 'default', 'value' => null],
            [['empleador_id', 'profesional_id', 'presupuesto_id'], 'integer'],
            [['comentario'], 'string', 'max' => 255],
            [['presupuesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presupuestos::className(), 'targetAttribute' => ['presupuesto_id' => 'id']],
            [['empleador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['empleador_id' => 'id']],
            [['profesional_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['profesional_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'voto' => 'Voto',
            'comentario' => 'Comentario',
            'created_at' => 'Created At',
            'empleador_id' => 'Empleador ID',
            'profesional_id' => 'Profesional ID',
            'presupuesto_id' => 'Presupuesto ID',
        ];
    }

    /**
     * Gets query for [[Presupuesto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresupuesto()
    {
        return $this->hasOne(Presupuestos::className(), ['id' => 'presupuesto_id']);
    }

    /**
     * Gets query for [[Empleador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleador()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'empleador_id']);
    }

    /**
     * Gets query for [[Profesional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesional()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'profesional_id']);
    }
}
