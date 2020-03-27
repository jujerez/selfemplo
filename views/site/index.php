<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Selfemplo';
?>
<div class="site-index">

    <div class="jumbotron jumbotron-fluid  ">
        <div class="align-self-center ">
            <h1 class="display-4 ">Contrata  profesionales</h1>
            <p class="lead">Millones de personas utilizan selfemplo.com para hacer realidad sus ideas</p>
            <div class="mt-2">
            
                <?= Html::a('Quiero contratar', ['/empleos/create'], ['class' => 'btn  btn-warning']) ?> 
                <?= Html::a('Quiero trabajar', ['/empleos/index'], ['class' => 'btn  btn-outline-light']) ?> 
                
            </div>

        </div>

    </div>


    <main class="body-content container mt-5">
   
        <div class="mb-5">
            <section class="row justify-content-around">
                <div class="col-md-12">
                    <h2 class="text-center "><b>Encontrar un profesional de confianza nunca ha sido tan facil</b></h2>
                    <p class="lead text-center">No pierdas el tiempo buscando en tablones de anuncios o preguntando a tus vecinos</p>
                   
                </div>
                  
                <div class="col-md-3 shadow">
                    <div class="contact-box center-version text-center p-3">
                        <?=Html::img('@web/img/form.png', ['class' => ['img-tarjeta'], 'alt' => 'Publica tu empleo'])?>
                        <h3><strong>Publica tu empleo</strong></h3>
            
                        <p class="text-black-50">Indicanos que profesional buscas y a que sector pertenece</p>
                
                    </div>
                </div>
                <div class="col-md-3 shadow">
                    <div class="contact-box center-version text-center p-3">
                         <?=Html::img('@web/img/puja2.png', ['class' => ['img-tarjeta'], 'alt' => 'Recibe presupuestos'])?>

                        <h3><strong>Recibes presupuestos</strong></h3>
            
                        <p class="text-black-50">En poco tiempo recibiras pujas de diferentes profesionales</p>
                
                    </div>
                </div>
                <div class="col-md-3 shadow">
                    <div class=" text-center p-3">
                       
                    <?=Html::img('@web/img/auction.png', ['class' => ['img-tarjeta'], 'alt' => 'Escoge un presupuesto'])?>
                        <h3><strong>Escoge un presupuesto</strong></h3>
                        <p class="text-black-50">Compara presupuestos y escoge el presupuesto que más te interese</p>
                
                    </div>

                </div>   
            </section>
        </div>
    
    </main>
</div>
