
<?php

$texto_prefooter = get_field( 'texto_prefooter' );
$texto_boton     = get_field( 'texto_boton' );
$enlace_boton    = get_field( 'enlace_boton' );

?>

<!-- PREFOOTER ENTRE BLOQUES-->
<div class="prefooter prefooter-entre-bloques">
    
    <div class="container-custom">
        
        <div class="row">
            
            <div class="col-12 col-md-6 izq">
                
                <h2><?php echo $texto_prefooter; ?></h2>

            </div>

            <div class="col-12 col-md-6 der">
                
                <div class="boton-cupa-blanco">

                    <a href="<?php echo $enlace_boton; ?>">
                        <?php echo $texto_boton; ?>
                        <span class="arrow-btn"></span>
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>