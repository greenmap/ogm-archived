$Id: README.txt,v 1.1.2.4 2008/10/13 23:09:12 jareyero Exp $

Localization client
--------------------------------------------------------------------------------
Project page:  http://drupal.org/project/l10n_client
Support queue: http://drupal.org/project/issues/l10n_client

ABOUT
--------------------------------------------------------------------------------

The module provides on-page localization editing which will possibly be
able to syndicate the provided local translations with a central localization
server (see the l10n_server project). Communication in the other direction
(sharing translations from the server to the client) might come in a later
version.

This 6.x functionality depends on features only available in Drupal 6.x, so
to make it work with Drupal 5, we ship our own version of locale module that
will replace the original Druupal core locale module.

INSTALLATION
--------------------------------------------------------------------------------

1. Enable l10n_client at Administer > Site configuration > Modules.
2. Ensure that at least one foreign language is activated on the site.
3. Make sure that the user roles you would like to give on-page localization
   access to have "use on-page translation" permission.

HOW DOES IT WORK
--------------------------------------------------------------------------------

When you are visiting a page on your site, which is displayed in a foreign
language (ie. not the built-in English), *and* you have permission to do
on-page translation, a little tool appear at the bottom of the page, which
allows you to translate strings used to build that exact page, and save
translations to your local database.

CONTRIBUTORS
--------------------------------------------------------------------------------
G�bor Hojtsy http://drupal.org/user/4166 (original author)
Young Hahn / Development Seed - http://developmentseed.org/ (friendly user interface)

Initial development of this module was sponsored by Google Summer of Code 2007.
