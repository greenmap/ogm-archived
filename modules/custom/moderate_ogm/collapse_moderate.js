// $Id: collapse.js,v 1.10 2007/01/11 03:38:31 unconed Exp $

/**
 * @author Miikka Lammela
 * @param http_request Object includes all data printed
 * @param returnArgs mixed Anything you might need to put to return handler function
 * this is a return handler function for Drupal.toggleFieldset function
 * @see moderate_ogm.module
 */
Drupal.divReturn = function (http_request,returnArgs){
	document.getElementById('DIV'+returnArgs.attributes.getNamedItem('name').value).innerHTML = http_request.responseText;
}
/**
 * Toggle the visibility of a fieldset using smooth animations
 */
Drupal.toggleFieldset = function(fieldset) {
  if ($(fieldset).is('.collapsed')) {
    var content = $('> div', fieldset).hide();
    $(fieldset).removeClass('collapsed');
	// AJAX
	// moderate/ajax
	//alert('base:' + Drupal_base_path);
	//alert('name:' +fieldset.attributes.getNamedItem("name").value);
	//Drupal.makeRequest(Drupal_base_path + Drupal_current_path+'/content.php','',"testReturn",fieldset);
	Drupal.makeRequest(Drupal_base_path + '/moderate/ajax/'+fieldset.attributes.getNamedItem("name").value,'',"divReturn",fieldset);

    content.slideDown(300, {
      complete: function() {
        // Make sure we open to height auto
        $(this).css('height', 'auto');
        Drupal.collapseScrollIntoView(this.parentNode);
        this.parentNode.animating = false;
      },
      step: function() {
         // Scroll the fieldset into view
        Drupal.collapseScrollIntoView(this.parentNode);
      }
    });
    if (typeof Drupal.textareaAttach != 'undefined') {
      // Initialize resizable textareas that are now revealed
      Drupal.textareaAttach(null, fieldset);
    }
  }
  else {
    var content = $('> div', fieldset).slideUp('medium', function() {
      $(this.parentNode).addClass('collapsed');
      this.parentNode.animating = false;
    });
  }
}

/**
 * Scroll a given fieldset into view as much as possible.
 */
Drupal.collapseScrollIntoView = function (node) {
  var h = self.innerHeight || document.documentElement.clientHeight || $('body')[0].clientHeight || 0;
  var offset = self.pageYOffset || document.documentElement.scrollTop || $('body')[0].scrollTop || 0;
  var pos = Drupal.absolutePosition(node);
  var fudge = 55;
  if (pos.y + node.offsetHeight + fudge > h + offset) {
    if (node.offsetHeight > h) {
      window.scrollTo(0, pos.y);
    } else {
      window.scrollTo(0, pos.y + node.offsetHeight - h + fudge);
    }
  }
}

// Global Killswitch
if (Drupal.jsEnabled) {
  $(document).ready(function() {
    $('fieldset.collapsible > legend').each(function() {
      var fieldset = $(this.parentNode);
      // Expand if there are errors inside
      if ($('input.error, textarea.error, select.error', fieldset).size() > 0) {
        fieldset.removeClass('collapsed');
      }

      // Turn the legend into a clickable link and wrap the contents of the fieldset
      // in a div for easier animation
      var text = this.innerHTML;
      $(this).empty().append($('<a href="#">'+ text +'</a>').click(function() {
	  	
        var fieldset = $(this).parents('fieldset:first')[0];
        // Don't animate multiple times
        if (!fieldset.animating) {
			
		  // let's hide all other fieldsets
		  for (a = 0; a < fieldset.parentNode.childNodes.length; a++) {
		  	var item = fieldset.parentNode.childNodes.item(a);
			if(item.tagName != 'FIELDSET'){continue;}
			if ($(item).is('.collapsed')) {continue;}
			if(item == fieldset){continue;}
			window.setTimeout(function(item){
  				if (item.animating) {return;}
				item.animating = true;
				Drupal.toggleFieldset(item);
			},(1000+ (a * 100)),item); // setTimout
		  }// for 
          fieldset.animating = true;
          Drupal.toggleFieldset(fieldset);
        }
        return false;
      })).after($('<div class="fieldset-wrapper"></div>').append(fieldset.children(':not(legend)')));
    });
  });
}
