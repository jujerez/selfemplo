<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property bool $moderado 
 * @property string $created_at
 * @property int $poblacion_id
 * @property int $empleador_id
 * @property int $profesion_id
 * @property Poblaciones $poblacion
 * @property Profesiones $profesion
 * @property Usuarios $empleador
 * @property Presupuestos[] $presupuestos
 */
class Empleos extends \yii\db\ActiveRecord
{
   private  $_precio_medio = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'poblacion_id', 'empleador_id', 'profesion_id'], 'required'],
            [['created_at'], 'safe'],
            [['poblacion_id', 'empleador_id', 'profesion_id'], 'default', 'value' => null],
            [['poblacion_id', 'empleador_id', 'profesion_id'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
            [['moderado'], 'boolean'], 
            [['!provincia'], 'safe'],
            [['!sector'], 'safe'],
            [['descripcion'], 'string'],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
            [['profesion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesiones::className(), 'targetAttribute' => ['profesion_id' => 'id']],
            [['empleador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['empleador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripción',
            'created_at' => 'Fecha de publicación',
            'poblacion_id' => 'Población',
            'moderado' => 'Moderado',
            'empleador_id' => 'Empleador ID',
            'profesion_id' => 'Profesion ',
            'sector' => 'Sector al que pertenece el profesional'
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['provincia'], ['sector'] );
    }

    /**
     * Gets query for [[Poblacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoblacion()
    {
        return $this->hasOne(Poblaciones::className(), ['id' => 'poblacion_id'])->inverseOf('empleos');
    }

    /**
     * Gets query for [[Profesion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesion()
    {
        return $this->hasOne(Profesiones::className(), ['id' => 'profesion_id'])->inverseOf('empleos');
    }

    /**
     * Gets query for [[Empleador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleador()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'empleador_id'])->inverseOf('empleos');
    }

    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id'])->via('poblacion');
    }

    public function getSector()
    {
        return $this->hasOne(Sectores::className(), ['id' => 'sector_id'])->via('profesion');
    }

    public function setPrecioMedio($precio_medio)
    {
        $this->_precio_medio = $precio_medio;
    }

    public function getPrecioMedio()
    {
        if ($this->_precio_medio === null && !$this->isNewRecord) {
            $this->setPrecioMedio($this->getPrecio());
        }
        return $this->_precio_medio;
    }

    /**
     * Metodo que devuelve el nombre del empleador
     *
     * @return string 
     */
    public function getNombre() {

        $query = (new \yii\db\Query())
        ->select('e.nombre')
        ->from('usuarios u')
        ->join('left join', 'empleadores e', 'u.id = e.usuario_id')
        ->where(['id' => $this->empleador_id])
        ->one();

        return $query['nombre'];
    }

     /**
     * Metodo que devuelve el precio medio de un presupuesto
     *
     * @return string 
     */
    public function getPrecio() {

        $query = (new \yii\db\Query())
        ->select('AVG(precio) AS precio_medio')
        ->from('empleos e')
        ->join('left join', 'presupuestos p', 'e.id = p.empleo_id')
        ->where(['e.id' => $this->id])
        ->one();

        return $query['precio_medio'];
    }
    

    /**
     * Gets query for [[Presupuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresupuestos()
    {
        return $this->hasMany(Presupuestos::className(), ['empleo_id' => 'id'])->inverseOf('empleo');
    }
}
