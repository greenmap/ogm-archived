

        FORWARD MODULE - README
______________________________________________________________________________

NAME:       Forward
AUTHORS:    Sean Robertson <seanr@ngpsoftware.com>
            Peter Feddo
______________________________________________________________________________


DESCRIPTION

Adds a "forward this page" link to each node. This module allows users to
forward a link to a specific node on your site to a friend.  You can customize
the default form field values and even view a running count of the emails sent
so far using the forward module.


INSTALLATION

Step 1) Download latest release from http://drupal.org/project/forward

Step 2)
  Extract the package into your 'modules' directory.


Step 3)
  Enable the forward module.

  Go to "administer >> build >> modules" and put a checkmark in the 'status' column next
  to 'forward'.


Step 4)
  Go to "administer >> site configuration >> forward" to configure the module.
  
  If you wish to customize the emails, copy 'forward.tpl.php' into your theme directory.
  Then you can customize the function as needed and those changes will only appear went
  sent by a user using that theme.

  If you upgraded from an earlier version of Forward, your site may be configured
  to use the older theme functions in forward.theme (you can change this in the
  forward settings page).  If so, follow these instructions:

  Edit 'forward.theme' to change the look and feel of your emails.  You can also
  create different themes for different phptemplate themes with by copying the
  contents of 'forward.theme' into your theme's 'template.php' file and
  prepending the function name with 'phptemplate_'.  Then you can customize the
  function as needed and those changes will only appear went sent by a user using
  that theme.  For more information, see the Drupal handbook:

  http://drupal.org/node/11811


Step 5)
  Enable permissions appropriate to your site.

  The forward module provides several permissions:
   - 'access forward': allow user to forward pages.
   - 'access epostcard': allow user to send an epostcard.
   - 'override email address': allow logged in user to change sender address.
   - 'administer forward': allow user to configure forward.
   - 'override flood control': allow user to bypass flood control on send.

  Note that you need to enable 'access forward' for users who should be able to
  send emails using the forward module.


Step 6)
  Go to "administer >> logs >> forward tracking" to view forward usage statistics.


DYNAMIC BLOCK ACCESS CONTROL

The 6.x-1.21 release of the Forward module added a new security field
for administators on the Forward configuration page named Dynamic Block
Access Control.  This field allows the administrator to control which
permissions are used when Drupal applies access control checks to the nodes,
comments or users listed in the Dynamic Block.  Several access control
options are available, including a bypass option.  The bypass option allows
the email recipient to possibly view node titles, comment titles, or user
names that only privileged users should see. The bypass option should not
normally be selected, but is provided for sites that used prior versions
of Forward and rely on the access bypass to operate correctly.

IMPORTANT: Because the default for the new field is to apply access control,
administrators of sites that rely on the access bypass to operate correctly
need to visit the Forward configuration page and explicitly select the bypass
option after upgrading from versions of Forward prior to 6.x-1.21.


CLICKTHROUGH COUNTER FLOOD CONTROL

The Forward module tracks clicks from links in sent emails to determine which
nodes get the most clickthroughs.  The method used could allow someone to
manipulate clickthrough counts via CSRF - for example, placing an image on
a website with a src tag that points to the clickthrough counter link.  The
module uses flood control to limit the number of clickthroughs from a given
IP address in a given time period to migitate this possibility.


CREDITS & SUPPORT

Special thanks to Jeff Miccolis of developmentseed.org for supplying the
tracking features and various other edits.  Thanks also to Nick White for his
EmailPage module, some code from which was used in this module, as well as the
numerous other users who have submitted issues and patches for forward.

All issues with this module should be reported via the following form:
http://drupal.org/node/add/project_issue/forward

______________________________________________________________________________
http://www.ngpsystems.com