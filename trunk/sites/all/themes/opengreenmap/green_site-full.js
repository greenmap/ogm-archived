// an attempt to break all the javascript out of the multimedia tab-related
// portions of green_site-full.tpl.php, to make the js easier to debug and alter


var multimedia_main = new Array();
var multimedia_description = new Array();


// php vars:
// $i                   --> php_var_i
// $media
// $media[$i]['view']   -->  media_i_quotes_view


//                                                    str_replace(array("\r\n", "\n", "\r"), '', addslashes($media[$i]['view'])).'\';';
multimedia_main['multimedia_item_'+ php_var_i] = media_i_quotes_view; // this string has had the above string replaces done on it ^

//                                                            str_replace(array("\r\n", "\n", "\r"), '', addslashes(multimedia_content_media_description($media[$i], $name))).'\';';
multimedia_description['multimedia_item_'+ php_var_i] = media_content_media_description_
