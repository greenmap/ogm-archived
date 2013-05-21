$Id:

Language Sections module for Drupal 6.x
=======================================

Description:

Language Sections is a simple "input filter" module to allow text sections in several languages to be stored in a single text field.  One typical application is with the "Views" module with its header, footer and "not found" text fields.

Optional patch to filter.module
===============================
Optionallly install the included patch check_markup_language_patch_1.patch - this allows the output from Language Sections to be cached by Drupal's filter caching mechanism, so potentially increasing performance considerably. The patch is not known to have any undesired side-effects.  It will not be necessary in Drupal 7 as that already includes the functionality provided by this patch. The patch needs to be applied to filter.module in the drupal/modules directory.

Further information: http://drupal.org/project/language_sections

Contact: http://www.netgenius.co.uk/contact

