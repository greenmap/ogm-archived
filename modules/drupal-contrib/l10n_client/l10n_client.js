// $Id: l10n_client.js,v 1.2.4.5 2008/10/22 20:22:44 goba Exp $

// Drupal 6 to Drupal 5 Backport notes
// Some elements produce an error when using the text('mytext') property
// so I'm replacing them by empty().append('text')

// Set "selected" string to unselected, i.e. -1
Drupal.extend({ l10nClientSelected: -1 });

// Define method for toggling l10n_client window and saving its state
// in a cookie.
Drupal.extend({
  
  l10nClientToggle:
  function(state) {
    switch(state) {
      case 1:
        $('#l10n-client-string-select, #l10n-client-string-editor, #l10n-client .labels .label').show();
        $('#l10n-client').height('22em').removeClass('hidden');
        // This one throws an error: "r has no properties"
        $('#l10n-client .labels .toggle').empty().append('X');
        if(!$.browser.msie) {
          $('body').css('border-bottom', '22em solid #fff');
        }
        $.cookie('Drupal_l10n_client', '1', {expires: 7, path: '/'});
      break;
      case 0:
        $('#l10n-client-string-select, #l10n-client-string-editor, #l10n-client .labels .label').hide();
        $('#l10n-client').height('2em').addClass('hidden');
 	
        // This one throws an error: "r has no properties"
        $('#l10n-client .labels .toggle').empty().append('Translate Text');
        
        if(!$.browser.msie) {
          $('body').css('border-bottom', '0px');
        }
        $.cookie('Drupal_l10n_client', '0', {expires: 7, path: '/'});
      break;        
    }
  },
  
  l10nClientGetString:
  function(index, type) {
    return $('#l10n-client-data div:eq('+index+') .'+type).html();
  },
  l10nClientSetString:
  function(index, data) {
    $('#l10n-client-data div:eq('+index+') .target').html(data);
  },
  l10nClientStringCount:
  function() {
    return $('#l10n-client-data div').size();
  },
  l10nClientFilter:
  function(action) {
    switch(action) {
      case 0:
        $('#l10n-client-string-select li').show();
        $('#l10n-client #edit-search').val('');
      break;
      case 1:
        var searchstr = $('#l10n-client #edit-search').val();
        if(searchstr.length > 0) {
          $('#l10n-client-string-select li').hide();
          $('#l10n-client-string-select li:contains('+searchstr+')').show();
        }
      break;
    }
  }
  
});

/**
 * Attaches the localization editor behaviour to all required fields.
 */

Drupal.l10nEditorAttach = function () {
  switch($.cookie('Drupal_l10n_client')) {
    case '1':
      Drupal.l10nClientToggle(1);
    break;
    default:
      Drupal.l10nClientToggle(0);
    break;
  }

  // If the selection changes, copy string values to the source and target fields.
  // Add class to indicate selected string in list widget.
  $('#l10n-client-string-select li').click(function() {
    $('#l10n-client-string-select li').removeClass('active');
    $(this).addClass('active');
    var index = $('#l10n-client-string-select li').index(this);
    $('#l10n-client-string-editor .source-text').empty().append(Drupal.l10nClientGetString(index, 'source'));
    $('#l10n-client-form #edit-lid').val(Drupal.l10nClientGetString(index, 'lid'));
    $('#l10n-client-form #edit-target').val(Drupal.l10nClientGetString(index, 'target'));
    Drupal.l10nClientSelected = index;
  });

  // When l10n_client window is clicked, toggle based on current state.
  $('#l10n-client .labels .toggle').click(function() {
    if($('#l10n-client').is('.hidden')) {
      Drupal.l10nClientToggle(1);
    } else { 
      Drupal.l10nClientToggle(0);
    }
  });

  $('#l10n-client #search-filter-go').click(function() {
    Drupal.l10nClientFilter(1);
  });

  $('#l10n-client #search-filter-clear').click(function() {
    Drupal.l10nClientFilter(0);
  });

  // Copy source text to translation field on button click.
  $('#l10n-client-form #edit-copy').click(function() {
    $('#l10n-client-form #edit-target').val($('#l10n-client-string-editor .source-text').html());
  });

  // Clear translation field on button click.
  $('#l10n-client-form #edit-clear').click(function() {
    $('#l10n-client-form #edit-target').val('');
  });
  
  // Send AJAX POST data on form submit.
  $('#l10n-client-form').submit(function() {
    $.ajax({
      type: "POST",
      url: $('#l10n-client-form').attr('action'),
      // Send source and target strings.
      data: 'source=' + Drupal.encodeURIComponent($('#l10n-client-string-editor .source-text').html()) +
            '&lid=' + Drupal.encodeURIComponent($('#l10n-client-form #edit-lid').val()) +
            '&target=' + Drupal.encodeURIComponent($('#l10n-client-form #edit-target').val()) +
            '&location=' + Drupal.encodeURIComponent($('#l10n-client-form #edit-location').val()) +
            '&form_token=' + Drupal.encodeURIComponent($('#l10n-client-form #edit-l10n-client-form-form-token').val()),
      success: function (data) {

        // Store string in local js
        Drupal.l10nClientSetString(Drupal.l10nClientSelected, $('#l10n-client-form #edit-target').val());

        // Empty input fields.
        $('#l10n-client-string-editor .source-text').html('');
        $('#l10n-client-form #edit-target').val('');

        // Mark string as translated.
        $('#l10n-client-string-select li').eq(Drupal.l10nClientSelected).removeClass('untranslated').removeClass('active').addClass('translated');        
        
      },
      error: function (xmlhttp) {
        // Backport note: we dont have js localization anymore
        alert('An HTTP error ' + xmlhttp.status + ' occured.');
      }
    });
    return false;
  });

};

if (Drupal.jsEnabled) {
  $(document).ready(Drupal.l10nEditorAttach);
}

