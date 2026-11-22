# Profile Views for Ultimate Member

## Description

=== Profile Views for Ultimate Member ===
Contributors: simplewpplugins
Tags: ultimate member, profile views, profile visitors, notifications, profile statistics
Requires at least: 6.0
Tested up to: 6.9
Requires PHP: 7.4
Requires Plugins: ultimate-member
Stable tag: 1.3.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Allow Ultimate Member users to see who viewed their profiles, receive profile-view notifications, and track visitor history.

== Description ==

**Profile Views for Ultimate Member** extends the [Ultimate Member](https://wordpress.org/plugins/ultimate-member/) plugin with profile-view tracking, notifications, and visitor information.

Users can see how many times their profiles have been viewed and access details about their visitors, including names, visit times, and available location information.

The plugin integrates with Ultimate Member's existing profile interface.

= Key Features =

* **Profile View Notifications:** Display notifications when users receive profile visits.
* **Profile Visitor History:** Allow users to see who has viewed their profiles.
* **Anonymous Visitor Tracking:** Track profile visits from visitors who are not logged in.
* **Visitor Information:** Display available visitor names, visit times, and location details.
* **Role-Based Controls:** Enable or disable profile views for individual Ultimate Member user roles.
* **Automatic Enablement:** Enable profile views by default on new installations.
* **Existing Settings Preserved:** Respect previously configured role settings when updating.
* **View History Management:** Allow users to clear their profile-view history.
* **Ultimate Member Integration:** Integrate with the existing Ultimate Member profile system.

= Visitor Location and Third-Party Services =

Earlier versions of Profile Views for Ultimate Member used [ip-api.com](https://ip-api.com/) to identify visitors' approximate geographical locations using their IP addresses.

In the updated v1.3.x implementation, automatic IP geolocation lookups are disabled by default. Previously stored location information may still be displayed.

If an administrator or developer enables an integration with ip-api.com, visitor IP addresses may be transmitted to the service for geolocation processing.

Before enabling this integration, review the [ip-api.com Terms and Policies](https://ip-api.com/docs/legal) and ensure that your website's privacy policy appropriately discloses the processing of visitor information.

The plugin does not require ip-api.com for its core profile-view tracking functionality.

= Privacy =

Profile Views for Ultimate Member records information about profile visits to provide visitor history and profile-view statistics.

Depending on the visitor type and available information, records may include:

* Visitor identity or an anonymous visitor identifier.
* Profile visited.
* Date and time of the visit.
* Previously recorded approximate location information.

New anonymous visitor records use hashed identifiers instead of storing raw IP addresses.

Website administrators are responsible for ensuring that visitor tracking complies with applicable privacy and data protection requirements.

= Video Demonstration =

[youtube https://youtu.be/8RyaNsYleqY]

== Screenshots ==

1. Profile View
3. Enable profile view feature

== Installation ==

= Automatic Installation =

1. Log in to your WordPress dashboard.
2. Navigate to **Plugins > Add New Plugin**.
3. Search for **Profile Views for Ultimate Member**.
4. Click **Install Now** and activate the plugin.
5. Ensure that Ultimate Member is installed and activated.

= Manual Installation =

1. Download the plugin ZIP file.
2. Navigate to **Plugins > Add New Plugin > Upload Plugin**.
3. Select the ZIP file and click **Install Now**.
4. Activate the plugin.
5. Ensure Ultimate Member is active.

= Configuration =

Profile Views is enabled by default for new installations.

To manage the feature for individual user roles:

1. Navigate to **Ultimate Member > User Roles**.
2. Edit the desired user role.
3. Locate the **Profile Views** settings.
4. Enable or disable **Enable profile views feature?**.
5. Save the changes.

Existing installations retain their previously configured role settings.

== Frequently Asked Questions ==

= Does this plugin require Ultimate Member? =

Yes. Ultimate Member must be installed and activated.

= Can anonymous visitors be tracked? =

Yes. Anonymous visitor tracking is enabled by default. Developers can disable it using the `pvum_track_anonymous_users` filter.

= Can administrators disable profile views for specific user roles? =

Yes. Profile-view functionality can be managed through Ultimate Member's user-role settings.

= Are profile views enabled automatically? =

On new installations, profile views are enabled by default. Existing installations are designed to preserve their previously configured settings.

= Does the plugin display visitor locations? =

Previously stored visitor locations may be displayed. Automatic geolocation lookups are disabled by default in the updated version.

= Will updating the plugin delete existing profile-view history? =

The update is designed to preserve existing profile-view history and settings.

== Developer Filters ==

= Disable Anonymous Visitor Tracking =

Anonymous visitors are tracked by default.

To disable anonymous tracking:

`add_filter( 'pvum_track_anonymous_users', '__return_false' );`

= Change View Count Refresh Interval =

The default refresh interval is 10000 milliseconds (10 seconds).

To change it to 15000 milliseconds (15 seconds):

`add_filter( 'pvum_count_refresh_interval', function( $interval ) { return 15000; } );`

== Changelog ==

= 1.3.3 =
* Improved compatibility with recent Ultimate Member versions.
* Improved profile-view tracking and notification handling.
* Improved AJAX security with nonce verification and authorization checks.
* Improved handling of anonymous profile visitors.
* Enabled profile views by default for new installations.
* Preserved existing role settings during updates.
* Improved Ultimate Member profile context handling.
* Updated plugin metadata and author information.
* Declared Ultimate Member as a required plugin dependency.
* Improved visitor data handling and privacy considerations.

= 1.3.2 =
* Introduced automatic enablement for new installations.
* Improved preservation of existing role settings.
* Updated plugin metadata.

= 1.3.1 =
* Improved AJAX request handling.
* Improved anonymous visitor identification.
* Improved handling of viewer records.
* Improved compatibility and error handling.

= 1.3.0 =
* Updated Ultimate Member dependency detection.
* Fixed AJAX class accessor.
* Added AJAX nonce verification.
* Improved date formatting and viewer record handling.
* Added configurable viewer history limits.
* Disabled automatic external IP geolocation lookups by default.

= 1.2.1 =
* Previous stable release.

== Upgrade Notice ==

= 1.3.3 =
Compatibility, security, and tracking improvements. Existing profile-view history and configured role settings are intended to remain unchanged.

## Installation

# Installation

## Requirements

Profile Views for Ultimate Member requires an active installation of the Ultimate Member plugin.

## Install Through WordPress

1. Log in to the WordPress administration dashboard.
2. Navigate to **Plugins → Add New Plugin**.
3. Select **Upload Plugin**.
4. Choose the Profile Views for Ultimate Member ZIP file.
5. Click **Install Now**.
6. Activate the plugin.

Ensure Ultimate Member is installed and active.

## Update an Existing Installation

1. Back up your WordPress database and plugin files.
2. Navigate to **Plugins → Add New Plugin → Upload Plugin**.
3. Upload the updated plugin ZIP.
4. Choose to replace the existing version when prompted.
5. Verify profile-view tracking and notifications.

Existing view history and role settings are intended to remain unchanged.

## Configuration

Navigate to **Ultimate Member → User Roles** and edit the relevant role.

Find the **Profile Views** settings and enable or disable the feature as needed.

On new installations, Profile Views is intended to be enabled by default.

## Usage

# Usage

## Viewing Profile Statistics

Once Profile Views is enabled, Ultimate Member users can receive profile-view notifications and access information about visitors to their profiles.

## Tracking Profile Visitors

The plugin tracks visits to Ultimate Member user profiles.

Visitor information may include:

- Visitor name, when available.
- Visit date and time.
- Previously recorded location information, when available.

Anonymous visitors may also be tracked.

## Managing Profile Views by Role

Administrators can control which Ultimate Member roles have access to the feature.

1. Open **Ultimate Member → User Roles**.
2. Select a role.
3. Find **Profile Views**.
4. Change the enable/disable setting.
5. Save the role.

## Anonymous Visitor Tracking

Anonymous tracking is enabled by default.

To disable it, add the following to a custom plugin or another appropriate code location:

```php
add_filter( 'pvum_track_anonymous_users', '__return_false' );
```

## Refresh Interval

The default view-count refresh interval is 10 seconds.

To change it to 15 seconds:

```php
add_filter( 'pvum_count_refresh_interval', function( $interval ) {
    return 15000;
} );
```

The interval is measured in milliseconds.

## Troubleshooting

If profile-view notifications are not appearing:

1. Confirm that Ultimate Member is active.
2. Confirm that Profile Views is enabled for the profile owner's role.
3. Visit the profile from another browser or private browsing session.
4. Check whether anonymous tracking has been disabled.
5. Check for JavaScript errors or blocked AJAX requests.

If the issue persists, test with other plugins temporarily disabled in a staging environment.

## Changelog

### 1.3.3 — 2026-11-22

# Profile Views for Ultimate Member — v1.3.3

This release focuses on improving compatibility with recent versions of Ultimate Member, strengthening security, and making profile-view tracking more reliable.

### What's New
- Improved compatibility with recent Ultimate Member versions.
- Profile Views is enabled by default on new installations.
- Existing installations retain their previously configured role settings.
- Improved tracking of logged-in and anonymous profile visitors.
- Improved AJAX request security with nonce verification and authorization checks.
- Improved handling of Ultimate Member profile context.
- Updated plugin metadata and declared Ultimate Member as a required dependency.
- Updated author information to Simple Plugins.

### Compatibility
- Requires Ultimate Member.
- Existing profile-view history is intended to remain unchanged during updates.

### Important Notes
- Anonymous visitor tracking can be disabled using the existing filter.
- New visitor geolocation is disabled by default.
- Previously stored visitor locations remain available.

**Release status:** Release candidate. Live integration and upgrade testing are still required before publishing as stable.

### 1.2.1 — Previous Stable Release

- Profile-view tracking for Ultimate Member user profiles.
- Profile-view notifications.
- Visitor history with available names, locations, and visit times.
- Support for tracking anonymous visitors.
- Role-based controls to enable or disable profile views.
- Developer filters for anonymous tracking and view-count refresh intervals.

**Note:** These are the features documented for v1.2.1, not a verified list of changes introduced specifically in that release. Earlier version-by-version changelog entries would need to be recovered from the original release history.
