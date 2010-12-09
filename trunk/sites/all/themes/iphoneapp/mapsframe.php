
<html>

<head>
  <title>Map It</title>
  <style type="text/css" media="screen">@import "../style.css";</style>
  <meta name = "viewport" content = "width = device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  </head>
  <?php $q = $_GET["q"]?>
<body onLoad="setTimeout(scrollTo, 100, 0, 1);" >

    <div class="toolbar">
     <span id="backButton" class="button" ONCLICK="history.go(-1)" style="display:block !important;">Back</span>
    </div>

     <div id="results" class="demo">
        <iframe height="370px" width="320px" name="resultbox" id="resultbox" style="border:none;" src="http://maps.google.com/maps?q=<?php echo $q ?>">
        </iframe>
    </div>
    </html>