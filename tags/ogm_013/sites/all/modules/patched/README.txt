The following changes have been made to third-party modules for this site.

Patches have also been applied to Drupal core for this site.  See
CHANGELOG.txt in the site document root for details.

gmap module:
  - small patch to views handler which allows passing macro settings from the
    og node so that map has correct centre & zoom level; see
    gmap/gmap_plugin_style_gmap.patch (TODO: submit to drupal.org)

recaptcha module:
  - properly pass the language code pt-BR to the reCAPTCHA API
    http://drupal.org/node/356348

primary_term module:
  - use primary term as default value during preview and edit when available
    http://drupal.org/node/343267
  - views primary term field should only show one term
    http://drupal.org/node/160382

location module:
  - give option to output coordinates in order expected by KML
    http://drupal.org/node/558144
  - check for valid country code http://drupal.org/node/685946

views_bonus module:
  - KML output option as views feed display
    http://drupal.org/node/558206
  - many changes to KML output to incorporate custom icon styles

og module:
  - add views field to output group nid(s), not just group name(s)
    http://drupal.org/node/426698

emfield module:
  - add views field option to output plain video & image urls
    http://drupal.org/node/523860

node_import module:
  - support option widgets http://drupal.org/node/384550#comment-1981918
  - support og_public field & fix og_groups field
    http://drupal.org/node/562634
  - ignore coordinate chooser field http://drupal.org/node/562646
  - support emfield CCK fields http://drupal.org/node/565424
  - support primary term module http://drupal.org/node/565430
  - support updating existing nodes if node id is supplied
    http://drupal.org/node/422282#comment-1995626
  - support node language field http://drupal.org/node/267555#comment-1995694
  - HACK: changed two field names which couldn't be changed in the CSV output
    ('Web Address - URL', and 'Are You Directly Involved in the Site?') in
    supported/cck/text.inc & supported/link/link.inc to make sure all fields
    mapped automatically; made the default term separator a comma in
    supported/taxonomy.inc

i18n module:
  - translate taxonomy terms in views http://drupal.org/node/346028#comment-1784958

multiselect module:
  - hacked to preserve order of options http://drupal.org/node/638748

taxonomy_image.module:
  - translate img alt attribute http://drupal.org/node/642950
  - fetch img from filesystem, not over http, to calculate img size
    http://drupal.org/node/438378#comment-2280398

mobile_tools module
  - removed the awful cache clear that was being run on every page
    http://drupal.org/node/642176
