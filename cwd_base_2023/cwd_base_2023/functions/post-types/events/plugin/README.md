# cd-events-pull-wp-plugin

Pulls events from the CU Calendar [Localist API](https://developer.localist.com/doc/api) and saves it to a WordPress custom content type.
Use the settings tab to controll how data is pulled, filtered, and loaded into WP custom content fields.

install with composer

```json
...
    {
        "type": "package",
        "package": {
            "name": "cubear/cd-events-pull-wp-plugin",
            "version": "dev-master",
            "type": "wordpress-plugin",
            "dist": {
            "type": "zip",
            "url": "https://github.com/CU-CommunityApps/cd-events-pull-wp-plugin/archive/master.zip"
            }
        }
    }
...
    "require": {
        "composer/installers": "^1.9",
        "cubear/cd-events-pull-wp-plugin": "dev-master"
    },