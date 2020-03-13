<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sectores".
 *
 * @property int $id
 * @property string $secnom
 *
 * @property Profesiones[] $profesiones
 */
class Sectores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sectores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['secnom'], 'required'],
            [['secnom'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'secnom' => 'Secnom',
        ];
    }

    /**
     * Gets query for [[Profesiones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesiones()
    {
        return $this->hasMany(Profesiones::className(), ['sector_id' => 'id'])->inverseOf('sector');
    }

    /**
     * Función que devuelve una lista de sectores
     *
     * @return Sectores[] sectores
     */
    public static function lista()
    {
        return static::find()
            ->select('secnom')
            ->orderBy('id')
            ->indexBy('id')
            ->column();
    }
}
