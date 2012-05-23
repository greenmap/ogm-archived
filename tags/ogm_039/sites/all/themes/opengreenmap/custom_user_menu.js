$(document).ready(function(){
//  jQuery('#custom-login ul.menu').superfish({OnClick: true});
  $('#block-menu-primary-links ul.menu').superfish({
    delay:       500,                              // one second delay on mouseout
    animation:   {opacity:'show',height:'show'},    // fade-in and slide-down animation
    speed:       'normal',                          // faster animation speed
    autoArrows:  false,                             // disable generation of arrow mark-up
    dropShadows: true                               // disable drop shadows
  });
});