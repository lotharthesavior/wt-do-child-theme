WT OceanWP Child Theme
=================

@author Savio Resende

WT Child Theme for the OceanWP WordPress theme. This theme adds useful functionalities for custom taxonomies to be displayed.

### Usage
By creating your own taxonomies, simply select the ones you want to see in after the title of your blog post or page.

#### Core features

##### Adding menu to the theme

At the file WTThemePlugin.php, customize this part of the code adding more items to the array, following the first element example:

```php
public static $menu_items_to_be_registered = [
    [
        'location' => 'wt_myaccount_menu',
        'description' => [
            'Words Tree My Account Menu',
            'wt-myaccount-menu'
        ]
    ]
];
```

These items will be available in the Theme's menu on the WP-Admin. Any menu can the attached to this location (e.g. "Words Tree My Account Menu").

**After add another page to the menu, it is necessary to visit the page Settings/Permalinks at the WP Admin Area.**


#### Shortcodes

 