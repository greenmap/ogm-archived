// this code is taken from the TextualZoomControl example

(function () {
    var container = document.createElement("div");
    // content goes here
    container.innerHTML = '<a href="http://www.greenmap.org/"><img src="'+Drupal_base_path+'sites/all/modules/custom/gmap_logo/logo.png" alt="" title="' + Drupal.t('Green Map System') + '"></a>';
    container.style.width = '90px';		// set container width explicitly

    // gmap handler

    Drupal.gmap.addHandler('gmap', function(elem) {
        var obj = this;
        
        obj.bind("init",function() {
            var map = obj.map;
            map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(container);
        });
    });
})();
