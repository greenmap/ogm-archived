if (Drupal.jsEnabled) {
  (function($) {
  $(document).ready(function() {
    var labels = Drupal.settings.compactlogin;
   
    $('label[@for="edit-name"], label[@for="edit-pass"]').remove();
   
    $('#edit-name').val(labels.username).focus(function() {
      $(this).val('');
    });
    $('#edit-pass').val(labels.password).focus(function() {
      $(this).attr('type', 'password').val('');
    });   
    return false;
  });
  })(jQuery);
}