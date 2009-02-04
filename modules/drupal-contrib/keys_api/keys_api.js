// $Id: keys_api.js,v 1.2 2008/03/10 23:26:56 greenskin Exp $

if (Drupal.jsEnabled) {
  $(document).ready(function() {
    
  });
  
  function setDomain() {
    $("#edit-domain").val(window.location.host);
  }
  
  function deleteItem(item) {
    $.each($("." + item + " td"), function(i, n) {
      if (i == 0) {
        domain = $(n).text();
      }
      if (i == 1) {
        service = $(n).text();
      }
    });
    
    $.post("/admin/settings/keys/delete_key",{name:domain,service:service},function(data) {
      $("#keys_table").empty().append(data);
    });
  }
}