<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presupuestos".
 *
 * @property int $id
 * @property float $precio
 * @property float|null $duracion_estimada
 * @property string|null $detalles
 * @property bool|null $estado
 * @property int $profesional_id
 * @property int $empleo_id
 *
 * @property Empleos $empleo
 * @property Usuarios $profesional
 */
class Presupuestos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presupuestos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precio', 'profesional_id', 'empleo_id'], 'required'],
            [['precio', 'duracion_estimada'], 'number'],
            [['precio',], 'number', 'min' => 0.01],
            [['duracion_estimada',], 'number', 'min' => 0.1],
            [['detalles'], 'string'],
            [['estado'], 'boolean'],
            [['created_at'], 'safe'],
            [['profesional_id', 'empleo_id'], 'default', 'value' => null],
            [['profesional_id', 'empleo_id'], 'integer'],
            [['empleo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empleos::className(), 'targetAttribute' => ['empleo_id' => 'id']],
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
            'precio' => 'Precio',
            'duracion_estimada' => 'Duración Estimada',
            'detalles' => 'Detalles',
            'estado' => 'Aprobado',
            'profesional_id' => 'Profesional ID',
            'empleo_id' => 'Empleo ID',
            'created_at' => 'Fecha de publicación',
        ];
    }

    /**
     * Gets query for [[Empleo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleo()
    {
        return $this->hasOne(Empleos::className(), ['id' => 'empleo_id'])->inverseOf('presupuestos');
    }

    /**
     * Gets query for [[Profesional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesional()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'profesional_id'])->inverseOf('presupuestos');
    }
}
