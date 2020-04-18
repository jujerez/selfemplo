<?php

namespace app\components;


use kartik\dialog\Dialog;
use kartik\icons\Icon;

class Util
{
    
    /**
     * Muestra mensaje de confirmación por defecto
     * 
     */
    public static function dialogo()
    {
        return Dialog::widget([
            'dialogDefaults' => [
                Dialog::DIALOG_CONFIRM => [
                    'type' => Dialog::TYPE_DANGER,
                    'title' => Icon::show('trash-alt'). ' ' . 'Eliminar',
                    'btnOKLabel' => 'Si',
                    'btnCancelLabel' => 'No',
                    'btnOKClass' => 'btn-danger',
                    'btnCancelClass' => 'btn-light',
                ],
                Dialog::DIALOG_ALERT => [
                    'type' => Dialog::TYPE_INFO,
                    'title' => Icon::show('info-circle'). ' ' . 'Información',
                    'btnOKLabel' => 'Ok',
                    'btnOKClass' => 'btn-info',
                    'btnCancelClass' => 'btn-light',
                ],
            ],
        ]);

    }

    /**
     * Muestra mensaje de politica de cookies
     * 
     */
    public static function dialogoPolitica()
    {
        return Dialog::widget([
            'overrideYiiConfirm' => false,
            'libName' => 'politica', 
            'options' => [
                'draggable' => true, 
                'closable' => false,
                'size' => Dialog::SIZE_MEDIUM, 
                'type' => Dialog::TYPE_INFO,
                'title' => 'Politica de cookies',
                'message' => 'Utilizamos cookies para asegurar que damos la mejor experiencia al usuario en nuestra web. Si sigues utilizando este sitio asumiremos que estás de acuerdo.',
                'btnOKClass' => 'btn-primary',
                'btnOKLabel' =>  'Vale',
                'btnCancelClass' => 'btn-light',
                'btnCancelLabel' =>  'No',
        
            ], 
         ]);

    }

 

    
}