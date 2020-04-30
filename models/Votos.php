<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "votos".
 *
 * @property int $id
 * @property int $voto
 * @property string $created_at
 * @property int $empleador_id
 * @property int $profesional_id
 *
 * @property Usuarios $empleador
 * @property Usuarios $profesional
 */
class Votos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'votos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voto', 'empleador_id', 'profesional_id'], 'required'],
            [['voto', 'empleador_id', 'profesional_id'], 'default', 'value' => null],
            [['voto', 'empleador_id', 'profesional_id'], 'integer'],
            [['created_at'], 'safe'],
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
            'created_at' => 'Created At',
            'empleador_id' => 'Empleador ID',
            'profesional_id' => 'Profesional ID',
        ];
    }

    /**
     * Gets query for [[Empleador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleador()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'empleador_id'])->inverseOf('votos');
    }

    /**
     * Gets query for [[Profesional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesional()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'profesional_id'])->inverseOf('votos0');
    }
}
