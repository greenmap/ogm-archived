The following changes have been made to third-party modules for this site.

Patches have also been applied to Drupal core for this site.  See
CHANGELOG.txt in the site document root for details.

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

views_bonus module:
  - KML output option as views feed display
    http://drupal.org/node/558206

og module:
  - add views field to output group nid(s), not just group name(s)
    http://drupal.org/node/426698

emfield module:
  - add views field option to output plain video & image urls
    http://drupal.org/node/523860
