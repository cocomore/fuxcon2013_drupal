<?php
/**
 * @file themes/fuxcon2013/template.php
 */

const FUXCON_NO_COLS = 3;
const FUXCON_COL_WIDTH = 4;

/**
 * Remove extra page title on project node pages.
 * prepocess_page() does not have the title yet.
 */
function fuxcon2013_process_page(&$vars) {
  $vars['title'] = NULL;
  $vars['page']['header'][] = array('#markup' => theme('header', $vars));
}

/**
 * Add class="container-narrow" to outermost page wrapper
 */
function fuxcon2013_process_html(&$vars) {
  $vars['page'] = preg_replace(
    '#(<div id="page-wrapper")>#', 
    '$1 class="container-narrow">', 
    $vars['page']
  );
}

/**
 * Hide local tasks for nodes
 */
function fuxcon2013_preprocess_menu_local_tasks(&$vars) {
  if (is_array($vars['primary']) && $vars['primary'][0]['#link']['path'] == 'node/%/view') {
    hide($vars['primary']);
  }
}

/**
 * Make the paginator work for bootstrap
 */
function fuxcon2013_preprocess_item_list(&$vars) {
  if (!in_array('pager', $vars['attributes']['class'])) {
    return;
  }
  unset($vars['attributes']['class']);
  $vars['theme_hook_suggestion'] = 'item_list__pager';
}

/**
 * Register theme functions
 */
function fuxcon2013_theme() {
  return array(
    'item_list__pager' => array(),
    'header' => array('template' => 'header'),
  );
}

function fuxcon2013_item_list__pager($vars) {
  return preg_replace(
    array('#(class="item-list)"#', '#<li class="pager-current([^"]*)">(\d+)</li>#'), 
    array('$1 pagination"', '<li class="pager-current$1 active"><a href="#">$2</a></li>'), 
    theme_item_list($vars)
  );
}
