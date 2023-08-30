# cd-news-pull-wp-plugin

Pulls news from the CU News [https://news.cornell.edu/rss-feeds](https://news.cornell.edu/rss-feeds). Only supports `[JSON]` feed and saves it to a WordPress custom content type.
Use the settings tab to controll how data is pulled, and loaded into WP custom content fields.

Use the settings page to configure. Extraction settings these are the fields to configure the Pull from cunews. Transform settings map the news data fields below to the custom content data fields. Load options are WordPress save/update configuartion options.

## Typical settings

This plugin is usually used with custom content types.

You can find typical Advanced Custom Fields and Custom Post Type UI settings in [/docs/news-ct.php](/docs/news-ct.php).) 

Install and enable the following plugins:

- Advanced Custom Fields
- Custom Post Type UI

I also recommend you install and enable the optional plugin WP Crontrol

copy /docs/news-ct.php to your theme root directory

in your theme functions.php add

```php
require_once( dirname( __FILE__ ) . '/news-ct.php' );
```

this will load the news-ct.php file and configure the custom content type.

next enable the CD News Pull plugin

and configure the settings page `/wp-admin/admin.php?page=cd-news-pull-wp-plugin-settings`

Then configure the settings as in the screenshot below.

![news-pull-settings](/docs/news-pull-settings.png)

then run the following cron job `lando wp cron event run cd_news_pull_cron_hook`

Then you should see the events in the custom News content list.

## Sites using this plugin.
 - https://sites.coecis.cornell.edu/mullergroup/news/
 - https://live-cihmid.pantheonsite.io/news/
