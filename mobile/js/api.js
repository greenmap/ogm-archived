/**
 * API functions to interact with GreenMaps API
 **/
window.GreenMaps = window.GreenMaps ? window.GreenMaps : {};
if (!GreenMaps.GreenApi){
  GreenMaps.GreenApi = new function() {
    var BASEURL = "http://www.opengreenmap.org/api/";

    /**
     * Get the /page/th page of POIs within /search_distance/ of 
     * /latitude/, /longitude/, and call /callback/ with the
     * result from the server.
     **/
    this.GetProximity = function(lat,
        lon,
        distance,
        units,
        page,
        callback) {
      var reqData = {
        "distance[latitude]": lat,
        "distance[longitude]": lon,
        "distance[search_distance]": distance,
        "distance[search_units]": units,
        "page": page
      };
      window.proximity = callback;
      $.getJSON(BASEURL + "proximity?callback=?", reqData, callback);
    };

    /**
     * Get detailed data about one POI with id number /nid/ and 
     * return to /callback/.
     **/
    this.GetFullData = function(nid, callback) {
      var reqData = {
        "nid": nid
      };
      window.site = callback;
      $.getJSON(BASEURL + "site?callback=?", reqData, callback);
    };
  };
}
