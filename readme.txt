=== Profile Views for Ultimate Member ===
Contributors: simplewpplugins
Tags: ultimate member, profile view, view count, view count notification.
Requires at least: 6.2
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.3.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html

Allows users to see their profile viewers

== Description ==

*Profile Views for Ultimate member* plugin requires [Ultimate Member](https://wordpress.org/plugins/ultimate-member) Plugin to work.

Visitor IP geolocation is disabled by default in version 1.3.0. Developers may provide a location using the `pvum_viewer_location` filter. Existing stored locations are preserved.

This plugin adds profile view notification to user's profile and displays viewers details including name, location and time.

[youtube https://youtu.be/8RyaNsYleqY]

== Screenshots ==
1. Profile View
3. Enable profile view feature

== Installation ==
**This section describes how to install the plugin and get it working**
= AUTOMATIC INSTALLATION (EASIEST WAY) =

To do an automatic install of *Profile Views for Ultimate Member*, log in to your WordPress dashboard, navigate to the Plugins menu and click
Add New.
In the search field type *"Profile Views for Ultimate Member"* by Simple Plugins. Once you have found it you can install it by simply clicking
"Install Now" and then "Activate".

= MANUAL INSTALLATION =

**Uploading in WordPress Dashboard**

* Download profile-views-for-ultimate-member.zip
* Navigate to the 'Add New' in the plugins dashboard
* Navigate to the 'Upload' area
* Select profile-views-for-ultimate-member.zip from your computer
* Click 'Install Now'
* Activate the plugin in the Plugin dashboard

**Using FTP**

* Download *profile-views-for-ultimate-member.zip*
* Extract the *profile-views-for-ultimate-member* directory to your computer
* Upload the *profile-views-for-ultimate-member* directory to the /wp-content/plugins/ directory
* Activate the plugin in the Plugin dashboard

The WordPress codex contains <a href="https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation">instructions</a> on how to install a WordPress plugin.




= Key Features List =
* Realtime profile view notification
* Profile viewer's approx. location, time and name.
* Enable or Disable profile view feature for certain user roles.

= Snippets =
**Track anonymous viewers (non-logged-in visitors):**
`Default: true
add_filter( 'pvum_track_anonymous_users',function( $v ){
	return false;
});`

**Change view count refresh interval:**
`Default : 10000 (milliseconds)
add_filter( 'pvum_count_refresh_interval',function( $interval ){
	return 15000;
} );`
== Changelog ==

= 1.3.1 =
* Fix profile view count and viewer list AJAX responses.
* Restrict viewer data and counts to the profile owner and verify AJAX nonces.
* Store hashed identifiers for new anonymous visitors instead of raw IP addresses.
* Preserve existing viewer history and support legacy records.
* Harden malformed history handling and viewer rendering.
* Target Ultimate Member 2.14.2; runtime verification still required.
