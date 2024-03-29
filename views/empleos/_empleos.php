<?php

use kartik\icons\Icon;
use yii\helpers\Html;

$js = <<<EOT
        
    $('.icono-share').on('click', function(){

        $('.icono-share').addClass('click');
        setTimeout(function(){
            
            $('.icono-share').removeClass('click');
        }, 2000);
    });
  
EOT;

$this->registerJs($js);

?>


<article class="row">
    <div class="col-12">
        <div class="card shadow p-4 mb-2 ">
         
            <div class="card-header p-2">
                <span class="text-success ">
                    <?= Html::encode($model->profesion->pronom) ?>
                </span>
                <span class=" text-muted float-right d-none d-sm-none d-md-block">
                    <?= Html::encode($model->profesion->sector->secnom) ?>
                </span>
            </div> 
            <div class="card-body" itemscope itemtype="http://schema.org/Offer">
 
                <h3 itemprop="name"><?=$model->titulo?></h3>
                <p itemprop="itemOffered" class="card-text mb-auto"><?= Html::encode($model->descripcion) ?></p>
                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="card-text mb-auto text-black-50"  >
                     <span itemprop="addressLocality"><?=Icon::show('map-marker-alt') . Html::encode($model->poblacion->nombre).', '. 
                        Html::encode($model->poblacion->provincia->nombre) ?></span>
                    
                </p>
                
                
                

                <div class="pt-3 d-flex justify-content-between">

                    <div class="share">

                        <?=Html::a(
                            Html::img('https://simplesharebuttons.com/images/somacro/facebook.png', ['alt'=>'Facebook', 'class' => ['icono-share ']]), 
                            'http://www.facebook.com/sharer.php?u=https://selfemplo.herokuapp.com/index.php?r=empleos%2Findex',
                            ['title' => 'Compartir en Facebook',]
                            ) 
                        ?>

                        <?=Html::a(
                            Html::img('https://simplesharebuttons.com/images/somacro/twitter.png', ['alt'=>'Twitter', 'class' => ['icono-share ']]), 
                            'https://twitter.com/share?url=https://libraryii.herokuapp.com/index.php?r=empleos%2Findex',
                            ['title' => 'Compartir en Twitter', ]
                            ) 
                        ?>
                            
                    </div>

                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    
                        <?php $model->precioMedio != null ?: $model->precioMedio = '0' ?> 
                        <span itemprop="price" class=" p-2 badge badge-pill badge-success text-uppercase text-center">
                            Precio medio: <?=Yii::$app->formatter->asDecimal($model->precioMedio). ' €'?>
                        </span>
                    </div>
                </div>
                <?php if (Yii::$app->user->isGuest || Yii::$app->user->identity->rol != '1') : ?>
                    <div class="pt-3">

                        <?=Html::a('Enviar presupuesto', ['presupuestos/create', 'id' => $key,], ['class' => 'btn btn-sm btn-success'])?>
                        
                    </div>
                <?php endif ?>
                
            </div>

            <div class="card-footer mt-3" itemscope itemtype="http://schema.org/Person">
                <span itemprop="startDate" class="float-right text-muted"><?= Icon::show('calendar-alt') . Yii::$app->formatter->asDate($model->created_at)?></span>
                <span itemprop="name" class="text-muted"><i class=""></i>Publicado por: <?= Html::encode($model->nombre)?></span>             
            </div>
        </div>
    </div>
</article>