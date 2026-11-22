## 1.3.3 (release candidate)
- Avoid modifying Ultimate Member active profile context while reading role settings.
- Preserve role-level enable/disable settings and new-install defaults.
- Update version metadata and packaging.
- Requires integration testing with the current Ultimate Member release before publication.

## 1.3.2
- Enable Profile Views by default for fresh installations when no role preference exists.
- Preserve explicitly enabled/disabled role preferences and legacy behavior on upgrades.
- Update author URL to the Simple Plugins GitHub organization.

# Changelog

## 1.3.0 (compatibility maintenance)
- Use Ultimate Member runtime functions for dependency detection.
- Fix AJAX accessor and protect viewer AJAX endpoints with login checks and nonces.
- Preserve the existing profile views role option and user metadata.
- Stop trusting visitor-supplied forwarded IP headers.
- Disable insecure third-party IP geolocation by default; provide `pvum_viewer_location` filter.
- Limit stored viewer records to 500 per profile by default (filter `pvum_max_viewers_per_profile`).
- Correct viewer date formatting and anonymous translation domain.
- Update JavaScript for nonce-protected requests.

Requires live WordPress and Ultimate Member 2.14.2 integration testing before production release.
