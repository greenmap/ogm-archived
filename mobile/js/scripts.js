//-----Application-data-----//
if (!window.GreenMaps) {
  window.GreenMaps = new (function() {
    var self = this;
    var map;
    var geocoder;
    var openInfoWindow;
    var mepin;
    this.mode = 'map';
    this.navState = 'navbarMain';
    this.view = 'main';
    this.geolocationEnabled = true;

    this.DEFAULT_SEARCH_DISTANCE = 5;
    this.DEFAULT_SEARCH_UNIT = 'mile';
    this.DEFAULT_VIEW_ZOOM = 14;
    this.SHOW_ICONS_AT_ZOOM_LEVEL = 6;
    this.NO_GEOLOCATION_VIEW_ZOOM = 3;
    this.NO_GEOLOCATION_LATITUDE = 39.8106460;
    this.NO_GEOLOCATION_LONGITUDE = -98.5569760;

    var pins = {};

    this.search_unit = 'mile';
    this.view_zoom = 14;

    //-----Map-Initialization-----//
    /**
     * Use geolocation to discover user's location.
     * Checks browser compatibility, then requests permission to geolocate.
     * On success, calls the given callback.
     * On failure, sends an error code to handle_error, which currently just changes
     * the prompt to "welcome".
     */
    this.geolocate = function(callback) {
      if(Modernizr.geolocation) {
        navigator.geolocation.getCurrentPosition(callback, this.handle_error, { maximumAge: 60000 });
      } else {
        this.handle_error( { code: 'POSITION_UNAVAILABLE' } );
      }
    }

    /**
     * Pins the map with data received from the GreenMap API.
     */
    this.pin_map = function(data) {
      updateList(data);

      GreenMaps.Misc.mapLoading(false);

      // Used to generate callbacks, fix closure issues in callbacks below.
      var makeCallback = function(marker, infowindow) {
        return function() {
          if(self.openInfoWindow != null) {
            self.openInfoWindow.close();
          }
          self.openInfoWindow = infowindow;
          infowindow.open(self.map, marker);
        };
      };

      // Callback to show a modal dialog with fancybox.
      window.showDetailsModal = function (nid) {
        var btn = $(".detailsLoadButton");
        btn.button("loading");
        GreenMaps.GreenApi.GetFullData(nid, function(data) {
          if(self.openInfoWindow != null) {
            self.openInfoWindow.close();
          }

          var placeDetails = new GreenMaps.PlaceDetails(data);
          placeDetails.displayData($("#modalContents"));
          GreenMaps.Misc.showModal();
        });
      }

      // Make a map pin with a popup bubble for each location returned
      for (i in data.locations) {
        var loc = data.locations[i].location;
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(loc.latitude, loc.longitude),
            title: GreenMaps.Misc.unformat(loc.title),
            map: self.map,
            icon: loc.icon_image
        });


        pins["" + loc.nid] = marker;

        var bubbleContents = loc.title + "<br>";
        bubbleContents += GreenMaps.Misc.formatDistance(loc.distance);
        bubbleContents += "<br><button class='btn btn-primary detailsLoadButton' \
                           type='button' \
                           data-loading-text='Loading...'  \
                           onclick='showDetailsModal(" + loc.nid + ")' \
                           >More Info</button>";

        var infowindow = new google.maps.InfoWindow({
          content: bubbleContents
        });
        google.maps.event.addListener(marker, 'click', makeCallback(marker, infowindow));
      };
    };

    /**
     * Calculates the maximum radius of locations that can be displayed
     * in the current map frame, then calls out to the GreenMap API
     * to find locations in the current frame. Calls the pin_map callback
     * after results are found.
     */
    this.pin_current_bounds = function() {
      // Pythagorean approx. of bounds
      // accurate for equirectangular projection, but
      // this will be off at high zoom levels
      if (self.view_zoom >= self.SHOW_ICONS_AT_ZOOM_LEVEL) {      
        var radians = function(deg) { return deg * (3.14159/180); };
        var bounds = self.map.getBounds();
        var lat2 = radians(bounds.getNorthEast().lat());
        var lat1 = radians(bounds.getCenter().lat());
        var lon2 = radians(bounds.getNorthEast().lng());
        var lon1 = radians(bounds.getCenter().lng());
        var R = 6371; // km
        if(self.search_unit == 'mile') {
          R = 3959; // mi
        }
        var x = (lon2-lon1) * Math.cos((lat1+lat2)/2);
        var y = (lat2-lat1);
        var d = Math.sqrt(x*x + y*y) * R;

        GreenMaps.GreenApi.GetProximity(bounds.getCenter().lat(),
            bounds.getCenter().lng(), d/2,
            self.search_unit, 1, self.pin_map);
        GreenMaps.Misc.mapLoading(true);
      }
    };

    this.zoom_changed = function() {
      self.view_zoom = self.map.getZoom();
    };

    /**
     * Centers the map on the given location, and places the "You are here" pin
     * at that location. Locates pins within the current screen bounds.
     */
    this.center_on_location = function(location) {
      self.view_zoom =  self.DEFAULT_VIEW_ZOOM;
      self.map.setZoom(self.view_zoom);
      self.map.setCenter(location);
      if(self.mepin != null) {
        self.mepin.setPosition(location);
      } else {
        self.mepin = new google.maps.Marker({position: location, map: self.map, title: "You are here"});
      }
      self.pin_current_bounds();
    }

    /**
     * Initializes the map at the given position.
     */
    this.show_map = function(position) {
      var mapOptions = {};
      if (self.geolocationEnabled) {
        mapOptions.center = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        mapOptions.zoom = self.DEFAULT_VIEW_ZOOM;
      } else {
        mapOptions.center = new google.maps.LatLng(self.NO_GEOLOCATION_LATITUDE, self.NO_GEOLOCATION_LONGITUDE);
        mapOptions.zoom = self.NO_GEOLOCATION_VIEW_ZOOM;
      }
      mapOptions.mapTypeId = google.maps.MapTypeId.ROADMAP;

      self.view_zoom = mapOptions.zoom;
      self.map = new google.maps.Map(document.getElementById('map_canvas'),
          mapOptions);
      google.maps.event.addListener(self.map, 'idle', self.pin_current_bounds);
      google.maps.event.addListener(self.map, 'zoom_changed', self.zoom_changed);
    }

    /**
     * Handles errors returned by the Geolocation API.
     */
    this.handle_error = function(err) {
      self.geolocationEnabled = false;
      $('#currentLocationButton').remove();
      self.show_map();
    }

    //-----Call-this-when-dom-ready-----//

    /**
     * After page load, initializes the Geocoder and the map pane.
     */
    this.initialize = function() {
      self.geocoder = new google.maps.Geocoder();
      self.geolocate(self.show_map);
    };

  })();
} else {
  alert("Init order error!");
}

/**
 * Creates a list of anchors in #listLocations. Input format below.
 * NOTE: pagination button callbacks not implemented
 * {
 *   "locations": [
 *     {
 *       "title": "SomeName",
 *       "nid": "43",
 *       "icon_image": "http://....",
 *       "distance": "0.1 mi"
 *     }
 *   ],
 *   "currentPage": 1,
 *   "pages": 3
 * }
 */
var updateList = function(data) {
  // Remove any locations currently there
  $("#listLocations").empty();
  // Create table for results
  var table = $('<table>', {
    class: 'table-striped',
    style: 'width: 100%',
  });
  // Create rows
  for(x in data['locations']) {
    var curLoc = data["locations"][x]["location"];
    if (curLoc.icon_image) {
      var image = '<td align="center"><img src="' + curLoc.icon_image + '" /></td>';
    } else {
      var image = '<td align="center"></td>';
    }

    // On click, open details
    var a = '<td><a href="#" onClick="showDetailsModal('+ curLoc.nid + ')">' + curLoc.title + '</a></td>';
    var span = '<td style="text-align: right"><span class="locationDistance">' + GreenMaps.Misc.formatDistance(curLoc.distance) + '</span></td>';
    $(table).append('<tr>' + image + a + span + '</tr>');
  }
  // Add the whole table
  $("#listLocations").append(table);
  // Don't display pagination if only 1 page
  // TODO: Add pagination support to use this
  if(data.pages && data['pages'] > 1) {
    var pagination = $('<div>', {
      class: 'pagination',
      style: 'text-align: center;'
    });
    // Disable previous if on first page
    var prevLi = $('<li>', {
      class: (data['currentPage'] == 1 ? "disabled" : " ")
    }).append($('<a>', {
      href: '#',
      text: 'Prev',
      class: (data['currentPage'] == 1 ? " " : "pageChanger")
    }));
    // Create pages: [n-2, n+2]
    var numLi = [];
    for(var i = Math.max(1, data['currentPage'] - 2); i <= Math.min(data['pages'], data['currentPage'] + 2); i++) {
      var currLi= $('<li>', {
        class: (i == data['currentPage'] ? "active" : " ")
      }).append($('<a>', {
        href: '#',
        text: i,
        class: (i == data['currentPage'] ? " " : "pageChanger")
      }));
      numLi.push(currLi);
    }
    // Disable next if on last page
    var nextLi = $('<li>', {
      class: (data['currentPage'] == data['pages'] ? "disabled" : " ")
    }).append($('<a>', {
      href: '#',
      text: 'Next',
      class: (data['currentPage'] == data['pages'] ? " " : " pageChanger")
    }));
    // Append all li elements
    var ul = $('<ul>');
    $(ul).append(prevLi);
    for(var i in numLi) {
      $(ul).append(numLi[i]);
    }
    $(ul).append(currLi);
    $(ul).append(nextLi);
    // Append ul to pagination
    $(pagination).append(ul);
    // APpend pagination to final div
    $("#listLocations").append(pagination);
    // Bind click handler
    $(".pageChanger").click(function() {
      var value = $(this).text();
      if(value == 'Prev') {
        //console.log("PREVIOUS PAGE");
      } else if(value == 'Next') {
        //console.log("NEXT PAGE");
      } else {
        //console.log("PAGE: " + value);
      }
    });
  }
}

$(function() {
  //-----Initialization-----//
  GreenMaps.initialize();

  /**
   * Fade view1 out, fade view2 in.
   */
  var swap = function(view1, view2) {
    $(view1).fadeOut('fast', function() {
      $(view2).fadeIn('fast');
    });
  };

  // Reposition the map div on resize
  // so it fits between the header and footer
  $(window).resize(function() {
    var headerHeight = 40;
    var footerHeight = $('#footer').height();
    var mapHeight = $(document).height() - headerHeight - footerHeight;
    $('#map').css({'top': headerHeight + 'px', 'height': mapHeight});
  }).resize();

  $('html').css('min-height', $(document).height());

  //-----Top-menu-button-functions-here-----//

  /**
   * When the expand button is clicked, expand
   * the menu unless already expanded
   */
  $('#expandButton').click(function() {
    if (GreenMaps.navState != 'navbarMain') {
      $('.' + GreenMaps.navState).slideUp(function() {
        $('.navbarMain').slideDown();
      });
      GreenMaps.navState = 'navbarMain';
    }
  });

  /**
   * When the location button is clicked, expand
   * the location sub-menu
   */
  $('#locationButton').click(function() {
    $('.' + GreenMaps.navState).slideUp(function() {
      $('.' + GreenMaps.navState).slideDown();
    });
    GreenMaps.navState = 'navbarLocation';

    if (GreenMaps.view != 'main') {
      swap('#form', '#content');
      GreenMaps.view = 'main';
    }
  });

  /**
   * When the suggest button is clicked, load the
   * form in an iframe
   */
  $('#suggestButton').click(function() {
    $('<a href="http://staging.opengreenmap.org/sites/default/files/app/addsites/locate.html">loading</a>').fancybox({
      onStart: function(){$('body').css("overflow: hidden;");},
      onClosed: function(){$('body').css("overflow: visible;");},
      overlayShow: true,
      "type": "iframe",
      "width": "100%",
      "height": "100%",
      autoScale: false
    }).click();
    $('#expandButton').click()
  });

  /**
   * When the about button is clicked show the fancybox
   */
  $('#aboutButton').click(function() {
    $.get('about.html', function (text) {
      $('#modalContents').html(text);
      GreenMaps.Misc.showModal();
    });
    $('#expandButton').click()
  });

  //-----Top-menu-location-sub-menu-buttons-----//

  /**
   * When the go button is clicked update the address
   */
  $('#addressButton').bind('click', function() {
    GreenMaps.geocoder.geocode({'address': $('#addressText').val()}, function(results) { GreenMaps.center_on_location(results[0].geometry.location);});
    $('#expandButton').click();
  });

  /**
   * When the current location button is pressed, show the
   * current location on the map
   */
  $('#currentLocationButton').click(function() {
    GreenMaps.geolocate(function(position) { GreenMaps.center_on_location(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));});
    $('#expandButton').click();
  });

  /**
   * When the back button is clicked go back to the main menu
   */
  $('#backButton').click(function() {
    $('.' + GreenMaps.navState).slideUp(function() {
      $('.navbarMain').slideDown();
    });
    GreenMaps.navState = 'navbarMain';
  });

  /**
    * Swap using opacity animationad z-index
    * fadeIn / fadeOut causes display: none
    * which causes the map to disappear and
    * the list to zero-out
    */
  $('#mapButton').click(function() {
    GreenMaps.mode = 'map';
    // Swap by changing opacity and z-index
    $("#list").animate({'opacity': 0}, function() {
      $("#list").css({'display': 'none'});
      var z = $("#map").css('z-index');
      $("#map").css('z-index', $("#list").css('z-index'));
      $("#list").css('z-index', z);
      $("#map").animate({'opacity': 1}, function() {
      });
    });
  });

  $('#listButton').click(function() {
    GreenMaps.mode = 'list';
    // Swap by changing opacity and z-index
    $("#map").animate({'opacity': 0, 'display': 'block'}, function() {
      var z = $("#map").css('z-index');
      $("#map").css('z-index', $("#list").css('z-index'));
      $("#list").css('z-index', z);
      $("#list").css({'display': 'block'});
      $("#list").animate({'opacity': 1});
    });
  });
  $("body").addClass("load");
});

/**
 * An object that contains details about a specific point of interest.
 *
 * Example Usage:
 *     var placeDetails = new GreenMaps.PlaceDetails(data);
 *     placeDetails.displayData($("#modalContents"));
 **/
GreenMaps.PlaceDetails = function(placeData) {
  var self = this;
  var init = function() {
    if (placeData.sites.length > 1) {
      //console.log("Multiple sites for nid " + sites[0].site.nid);
    }
    self.data = placeData.sites[0].site;
  };
  /**
   * Put formatted data into /targetDom/ for this location.
   **/
  this.displayData = function(targetDom) {
    var outContainer = $("<div />");

    // Name of POI
    $("<div />", {
      html: self.data.title,
      "class": "detailsTitle"
    }).appendTo(outContainer);

    //Large image
    if (self.data.image) {
      var centerDiv = $("<center>").appendTo(outContainer);
      $("<img />", {
        "src": self.data.image,
        "alt": self.data.icon_name,
        "class": "detailsImage"
      }).appendTo(centerDiv);
    }

    //Details icon
    $("<div />", {
      html: "<img src='" + self.data.icon_image + "' alt='" + self.data.icon_name + "' style='padding-right:5px;' />" + self.data.icon_name,
      "class": "detailsIcon"
    }).appendTo(outContainer);

    $("<div />", {
      "class": "clear"
    }).appendTo(outContainer);

    // Buttons to perform actions
    var detButtons = $("<div />", {
      "class": "detailsButtons"
    }).appendTo(outContainer);

    // Phone number (phone-clickable)
    if (self.data.phone) {
      $("<button />", {
        "type": "button",
        "class": "btn btn-primary btnFull",
        "html": self.data.phone,
        "click": GreenMaps.Misc.linkMe(GreenMaps.Misc.phoneLink(self.data.phone))
      }).appendTo(detButtons);
    }
    // Web address link
    if (self.data["Web Address"]) {
      $("<button />", {
        "type": "button",
        "class": "btn btn-primary btnFull",
        "click": GreenMaps.Misc.linkMe(self.data["Web Address"]),
        "html": "Website"
      }).appendTo(detButtons);
    }

    //Clean up newlines and replace them with <p> tags.
    var betterDetails = self.data.details.replace(/\n/g, "<p>");
    $("<div />", {
      html: betterDetails,
      "class": "detailsDetails"
    }).appendTo(outContainer);

    $(targetDom).html(outContainer);
  };
  init();
};

/**
 * Misc common utility functions
 **/
GreenMaps.Misc = new function() {
  this.showModal = function() {
    $('<a href="#modalContents">loading</a>').fancybox({
      onStart: function(){$('body').css("overflow: hidden;");},
      onClosed: function(){$('body').css("overflow: visible;");},
      overlayShow: true
    }).click();
  };
  /**
   * Whether to show map loading
   **/
  this.mapLoading = function(showLoading) {
    if (showLoading) {
      $("#map").spin();
    } else {
      $("#map").spin(false);
    }
  };
  /**
   * Translate a phone number to a tel:// link by
   * extracting only numbers.
   **/
  this.phoneLink = function(sourceText) {
    var out = "tel://";
    for (var i = 0; i < sourceText.length; i++) {
      if (sourceText[i] >= '0' && sourceText[i] <= '9') {
        out += sourceText[i];
      }
    }
    return out;
  };
  /**
   * Returns a function that opens /page/ in a new window.
   **/
  this.linkMe = function(page) {
    return function() { open(page, "_blank"); };
  };
  /**
   * Remove HTML characters or tags from /text/
   **/
  this.unformat = function(text) {
    return $("<div>", {html: text}).text();
  }
  /**
   * Trim a floating point /num/ and return a string
   * displaying up to /2/ digits of precision.
   **/
  this.trimFp = function(num, prec) {
    var dotPos = num.toString().indexOf(".");
    if (dotPos + prec + 1 > num.length) {
      return num;
    } else {
      return num.toString().substring(0, dotPos + prec + 1);
    }
  };
  /**
   * Format /startText/ containing miles (mi) into a mi/km text
   * with formatting.
   **/
  this.formatDistance = function(startText) {
    if (!startText)
      return '';
    var i = 0;
    function extractNumber(input) {
      var output = "";
      for (var i = 0; i < input.length; i++) {
        if ((input[i] >= '0' && input[i] <= '9') ||
            input[i] == '.') {
          output += input[i];
        }
      }
      return parseFloat(output);
    }
    if (startText.indexOf("mi") >= 0) {
      var miNum = extractNumber(startText);
      var kmNum = GreenMaps.Misc.trimFp(miNum / .62137, 2);
    }
    startText = "<span class='miDisp'>" + startText + "</span>";
    startText += " <span class='kmDisp'> / " + kmNum + " km</span>";
    return startText;
  }

};
