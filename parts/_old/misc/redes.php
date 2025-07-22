<?php if(have_rows('redes_sociales', 'options')): ?>
<ul class="navbar-nav nav-flex-icons d-flex flex-row">
    <?php
    while(have_rows('redes_sociales', 'options')): the_row();
    $facebook=get_sub_field('facebook');
    $twitter=get_sub_field('twitter');
    $lindkedin=get_sub_field('lindkedin');
    ?>
    <?php  if($facebook): ?>
        <li class="nav-item">
            <a href="<?php echo $facebook  ?>" class="nav-link"><i class="fa fa-facebook"></i></a>
        </li>
     <?php endif; ?>
    <?php  if($twitter): ?>
        <li class="nav-item">
            <a href="<?php echo $twitter  ?>" class="nav-link"><i class="fa fa-twitter"></i></a>
        </li>
    <?php endif; ?>
    <?php  if($lindkedin): ?>
        <li class="nav-item d-inline-block">
            <a href="<?php echo $lindkedin  ?>" class="nav-link"><i class="fa fa-linkedin"></i></a>
        </li>
    <?php endif; ?>
   <?php endwhile; ?>
</ul>
<?php  endif; ?>