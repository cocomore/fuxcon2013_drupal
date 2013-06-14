<div class="row">
  <div class="span5">
    <div class="thumbnail picture-content">
      <?php echo render($content['field_picture']); ?>
    </div>
    <?php echo render($content['field_dates']); ?>
    <?php if ($field_tags): ?>
      <p>
      <?php 
      echo '<strong>', t('Topics'), ':</strong>';
      foreach ($field_tags as $tag): ?>
        <?php
        $term = $tag['taxonomy_term'];
        echo '<span class="label">', $term->name, '</span> ';
        /*
        $uri = entity_uri('taxonomy_term', $term);
        echo l($term->name, $uri['path'], array('attributes' => array('class' => 'label'))); 
        */
        ?>
      <?php endforeach; ?>
      </p>
    <?php endif; ?>
    <p class="actions">
      <?php echo l('edit this project', "node/{$nid}/edit", array('attributes' => array('class' => 'btn', 'id' => 'edit-project'))); ?>
    </p>
  </div>
  <div class="span4">
      <h1 class="title-content"><?php echo $title; ?></h1>
      <div class="about-content"><?php echo render($content['body']); ?></div>
  </div>
</div>
