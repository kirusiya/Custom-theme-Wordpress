<div class="datos_contacto">
    <?php
    $email=get_field('email', 'options');
    $direccion=get_field('direccion', 'options');
    $tel=get_field('telefono', 'options');
    ?>
    <?php if($direccion): ?>
        <div class="contacto_item d-flex align-items-start contacto_phone">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span><?php echo $direccion ?></span>
        </div>
    <?php endif;  ?>
    <?php if($tel): ?>
        <div class="contacto_item d-flex align-items-start contacto_phone">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span><?php echo $tel ?></span>
        </div>
    <?php endif;  ?>
    <?php if($email): ?>
        <div class="contacto_item d-flex align-items-start contacto_phone">
            <i class="fa fa-envelope" aria-hidden="true"></i>
           <a href="mailto:<?php echo $email ?>"> <span><?php echo $email ?></span>
           </a>
        </div>
    <?php endif;  ?>
</div>