// $Id: multiselect.js,v 1.6.2.5 2009/05/29 17:43:55 attheshow Exp $

/**
 * The JavaScript behavior that goes with the Multiselect form element.
 */

Drupal.behaviors.multiselect = function(context) {
  // Remove the items that haven't been selected from the select box.
  $('select.multiselect_unsel:not(.multiselect-processed)', context).addClass('multiselect-processed').each(function() {
    unselclass = '.' + this.id + '_unsel';
    selclass = '.' + this.id + '_sel';
    $(unselclass).removeContentsFrom($(selclass));
  });

  // Note: Doesn't matter what sort of submit button it is really (preview or submit)
  // Selects all the items in the selected box (so they are actually selected) when submitted
  $('input.form-submit:not(.multiselect-processed)', context).addClass('multiselect-processed').click(function() {
    $('select.multiselect_sel').selectAll();
  });

  // Moves selection if it's double clicked to selected box
  $('select.multiselect_unsel:not(.multiselect-unsel-processed)', context).addClass('multiselect-unsel-processed').dblclick(function() {
    unselclass = '.' + this.id + '_unsel';
    selclass = '.' + this.id + '_sel';
    $(unselclass).moveSelectionTo($(selclass));
  });

  // Moves selection if it's double clicked to unselected box
  $('select.multiselect_sel:not(.multiselect-sel-processed)', context).addClass('multiselect-sel-processed').dblclick(function() {
    unselclass = '.' + this.id + '_unsel';
    selclass = '.' + this.id + '_sel';
    $(selclass).moveSelectionTo($(unselclass));
  });

  // Moves selection if add is clicked to selected box
  $('li.multiselect_add:not(.multiselect-add-processed)', context).addClass('multiselect-add-processed').click(function() {
    unselclass = '.' + this.id + '_unsel';
    selclass = '.' + this.id + '_sel';
    $(unselclass).moveSelectionTo($(selclass));
  });

  // Moves selection if remove is clicked to selected box
  $('li.multiselect_remove:not(.multiselect-remove-processed)', context).addClass('multiselect-remove-processed').click(function() {
    unselclass = '.' + this.id + '_unsel';
    selclass = '.' + this.id + '_sel';
    $(selclass).moveSelectionTo($(unselclass));
  });
};

// Selects all the items in the select box it is called from.
// usage $('nameofselectbox').selectAll();
jQuery.fn.selectAll = function() {
  this.each(function() {
    for (var x=0;x<this.options.length;x++) {
      option = this.options[x];
      option.selected = true;
    }
  });
}

// Removes the content of this select box from the target
// usage $('nameofselectbox').removeContentsFrom(target_selectbox)
jQuery.fn.removeContentsFrom = function() {
  dest = arguments[0];
  this.each(function() {
    for (var x=this.options.length-1;x>=0;x--) {
      dest.removeOption(this.options[x].value);
    }
  });
}

// Moves the selection to the select box specified
// usage $('nameofselectbox').moveSelectionTo(destination_selectbox)
jQuery.fn.moveSelectionTo = function() {
  dest = arguments[0];
  this.each(function() {
    for (var x=0; x < this.options.length; x++) {
      option = this.options[x];
      if (option.selected) {
        dest.addOption(option);
        this.remove(x);
        x--; // Move x back one so that we'll successfully check again to see if it's selected.
      }
    }
  });
}

// Adds an option to a select box
// usage $('nameofselectbox').addOption(optiontoadd);
jQuery.fn.addOption = function() {
  option = arguments[0];
  this.each(function() {
    //had to alter code to this to make it work in IE
    anOption = document.createElement('option');
    anOption.text = option.text;
    anOption.value = option.value;
    anOption.id = option.id;
    anOption.className = option.className;
    // add new option to list of options
    this.options[this.options.length] = anOption;

    /* 
     sorting based on code from jquery selectboxes plugin by Sam Collett
     http://www.texotela.co.uk/code/jquery/select/ (GPL)
     */

    // sort all options by class
    var o = this.options;
    var oL = o.length;
    var sA = [];
    // loop through options, adding to sort array
    for(var i = 0; i<oL; i++) {
      sA[i] = {
        val: o[i].value,
        text: o[i].text,
        className: o[i].className,
        id: o[i].id,
        disabled: $(o[i]).attr("disabled"),
        selected: $(o[i]).attr("selected")
      }
    }
    // sort items in array
    sA.sort(
      function(o1, o2) {
        if (o1.id == o2.id) { return 0; }
        // strip off unique identifier within id and do numeric comparison
        return parseInt(o1.id.substring(7)) < parseInt(o2.id.substring(7)) ? -1 : 1;
      }
    );
    // change the options to match the sort array
    for(var i = 0; i<oL; i++) {
      o[i].text = sA[i].text;
      o[i].value = sA[i].val;
      o[i].className = sA[i].className;
      o[i].id = sA[i].id;
      if (sA[i].disabled) {
        $(o[i]).attr("disabled", "disabled");
      } else {
        $(o[i]).removeAttr("disabled");
      }
      if (sA[i].selected) {
        $(o[i]).attr("selected", "selected");
      } else {
        $(o[i]).removeAttr("selected");
      }
    }

    return false;
  });
}

// Removes an option from a select box
// usage $('nameofselectbox').removeOption(valueOfOptionToRemove);
jQuery.fn.removeOption = function() {
  targOption = arguments[0];
  this.each(function() {
    for (var x=this.options.length-1;x>=0;x--) {
      option = this.options[x];
      if (option.value==targOption) {
        this.remove(x);
      }
    }
  });
}
