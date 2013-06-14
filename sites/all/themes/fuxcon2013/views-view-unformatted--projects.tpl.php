<?php
$columns = array();
foreach ($rows as $i => $row) {
  $col = $i % FUXCON_NO_COLS;
  $columns[$col][] = $row;
}
// krumo(get_defined_vars()); 
?>
<?php foreach ($columns as $column): ?>
	<div class="span<?php echo FUXCON_COL_WIDTH; ?>">
  <?php foreach ($column as $project): ?>
    <?php echo $project; ?>
  <?php endforeach; ?>
  </div>
<?php endforeach; ?>
