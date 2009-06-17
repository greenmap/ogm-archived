// $Id: admin_message_form.js,v 1.1.2.1 2007/08/04 19:44:53 fajerstarter Exp $

// Global Killswitch
if (Drupal.jsEnabled) {
  $(document).ready(function() {  
    // Hide the other options if "Show message (sticky)" is not checked.    
    $("#admin-message-toggle")[['hide', 'show'][Number($("#edit-sticky")[0].checked)]]();
    
    $("#edit-sticky").click(function() {
      $("#admin-message-toggle")[['hide', 'show'][Number(this.checked)]]();
    });
  });
}
