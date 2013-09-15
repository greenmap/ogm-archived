<!doctype html>
<html>
  <head>
    <!--Header fields for mobile browsers-->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!--Jquery-->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!--Modernizer-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    <!--Fancybox-->
    <script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script>
    <link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <!--Bootstrap-->
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.css" />
    <!--Spin-->
    <script src="js/spin.min.js" type="text/javascript"></script>
    <!--Google Maps-->
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2uer5iIwqr-diNgXLcA8UzTDTTNrm064&sensor=true">
    </script>
    <!--Application-->
    <title>Green Map Mobile</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/api.js"></script>
    <script type="text/javascript">
      window.addEventListener("load",function() {
        // Set a timeout...
        setTimeout(function(){
          // Hide the address bar
          window.scrollTo(0, 1);
        }, 0);
      });
    </script>
  </head>

  <body>
    <div id="headerWrapper">
      <div id="header" class="navbar greenGradient">
        <div class="navbar-inner greenGradient">
          <div class="container greenGradient">
            <a id="expandButton" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <a id="logo" class="brand" href="#" onclick="window.location.reload()"><img src="img/title.png" alt="Green Map"/></a>
            <div class="nav-collapse collapse">
              <ul id="menuButtons" class="nav">
                <!--The first set of nav buttons-->
                <li class="navbarMain"><a id="locationButton" href="#">Location</a></li>
                <!--  <li class="navbarMain"><a id="suggestButton" href="#">Add Site</a></li> -->
                <li class="navbarMain"><a id="aboutButton" href="#">About</a></li>

                <!--After pressing the location button-->
                <li class="navbarLocation" ><input id="addressText" type="text" placeholder="Enter an address..."><a id="addressButton" class="btn" style="display: inline;">Go</a></li>
                <li class="navbarLocation" ><a id="currentLocationButton" href="#">Current Location</a></li>
                <li class="navbarLocation" ><a id="backButton" href="#">&laquo; Back</a></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="content">
      <div id="map">
        <div id="map_canvas">
          <!--Splash screen while map is loading/awaiting geolocation approval-->
      		<div id="splash">
  	    		<img src="img/logo.png" alt="GreenMap Logo" />
  	    		<div id="loading_msg" style="white-space: nowrap; width:309px; margin:10px auto 0; text-align:center; font-size:80%;">zoom in for more sites</div>
      		</div>
      	</div>
      </div>

      <div id="list">
        <div id="listLocations">
          <!-- Buttons to trigger modal -->
        </div>
        <div id="footerSpacer"></div>
      </div>

      <div id="footerWrapper">
        <div id="footer" class="btn-group" data-toggle="buttons-radio">
          <button id="mapButton" type="button" class="btn active">Map</button>
          <button id="listButton" type="button" class="btn">List</button>
        </div>
      </div>
    </div>

    <div id="form"></div>

    <div style="display:none"><div id="modalContents"></div></div>

  </body>
</html>
