<?php
/**
 * @file search-theme-form.tpl.php
 * Custom theme implementation for displaying a search form directly into the
 * theme layout. Not to be confused with the search block or the search page.
 *
 * Available variables:
 * - $search_form: The complete search form ready for print.
 * - $search: Array of keyed search elements. Can be used to print each form
 *   element separately.
 *
 * Default keys within $search:
 * - $search['search_theme_form']: Text input area wrapped in a div.
 * - $search['submit']: Form submit button.
 * - $search['hidden']: Hidden form elements. Used to validate forms when submitted.
 *
 * Since $search is keyed, a direct print of the form element is possible.
 * Modules can add to the search form so it is recommended to check for their
 * existance before printing. The default keys will always exist.
 *
 *   <?php if (isset($search['extra_field'])): ?>
 *     <div class="extra-field">
 *       <?php print $search['extra_field']; ?>
 *     </div>
 *   <?php endif; ?>
 *
 * To check for all available data within $search, use the code below.
 *
 *   <?php print '<pre>'. check_plain(print_r($search, 1)) .'</pre>'; ?>
 *
 * Alternately you can use devel's debug feature
 *
 *   <?php dsm($search); ?>
 *
 * @see template_preprocess_search_theme_form()
 */
?>
<!--search-theme-form.tpl.php-->
<div id="search" class="container-inline">
  <div class="form-item" id="edit-search-theme-form-1-wrapper">
    <input type="text" maxlength="128" name="search_theme_form" id="edit-search-theme-form-1"  size="15" value="<?php print t('Search website'); ?>" title="<?php print t('Enter the terms you wish to search for.'); ?>" class="form-text" onblur="this.value='<?php print t('Search website'); ?>'" onfocus="this.value=''" />
  </div>
  <input type="submit" name="op" id="edit-submit-1" value="<?php print t('Go'); ?>"  class="form-submit" />
  <?php print $search['hidden']; ?>
</div>
<!--/search-theme-form.tpl.php-->