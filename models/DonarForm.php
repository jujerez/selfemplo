<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * DoanrForm es el modelo de formulario para donación Paypal.
 */
class DonarForm extends Model
{
    public $nombre;
    public $cantidad;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['nombre', 'cantidad'], 'required'],
            
            [['nombre'], 'string'],
            [['cantidad',], 'number', 'min' => 0.1],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'cantidad' => 'Cantidad a donar',
        ];
    }

    
}
