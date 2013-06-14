<?php
// krumo(get_defined_vars());
// Ähem, this is cheating:
?>
<div class="masthead">
	<ul class="nav nav-pills pull-right">
	  <?php
	  if ($user->uid):
		  ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php echo $user->name; ?><b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><?php echo l('Create project', 'node/add/project'); ?></li>
          <li><?php echo l('Logout', 'user/logout'); ?></li>
        </ul><!-- .dropdown-menu -->
      </li>
    <?php else: ?>
      <li><?php echo l('login', 'user/login'); ?></li>
    <?php endif; ?>
  </ul><!-- .nav -->
	<h3 class="muted"><?php echo l('Projects', '<front>'); ?></h3>
</div>
