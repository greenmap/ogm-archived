// $Id: admin_message.js,v 1.1 2007/07/21 12:38:29 fajerstarter Exp $

// Global Killswitch
if (Drupal.jsEnabled) {
  $(document).ready(function() {  
    // Close
    $("#block-admin_message-admin_message a.close").click(function() {
      var href = $(this).attr("href");
      $.get(href);
      $(this).parent().slideUp('fast');
      return false;
    });
  });
}
