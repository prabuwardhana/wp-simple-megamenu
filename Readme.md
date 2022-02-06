# Wordpress Simple Megamenu

[![Project Status: WIP – Initial development is in progress, but there has not yet been a stable, usable release suitable for the public.](https://www.repostatus.org/badges/latest/wip.svg)](https://www.repostatus.org/#wip)

This plugin turns your Wordpress navigation menu into a megamenu in simple steps

**Author:** prabuwardhana

**Tags:** Wordpress Navigation Menu, Wordpress Megamenu Navigation

**Requires at least:**

**Tested up to:** 5.9

**Requires PHP version:**

**Stable tag:**

**License:** GPLv2 or later (of course!)

**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

## Description

This plugin adds custo

This plugin adds custom fields on Appearance -> Menus page of wp-admin (see [screenshots](#screenshots)).
It uses `wp_nav_menu_item_custom_fields` hook added in WordPress 5.4 and Walker_Nav_Menu_Edit for earlier version of WordPress release to add custom fields.  
These options allows you to turn your normal and boring navigation menu into a stunning megamenu for your WordPress site.

**Note:** This plugin works with default themes. In order to use it with custom themes, please add the necessary styling.

## Installation

1. Extract the zip file.
2. Upload it to the `/wp-content/plugins/` directory in your WordPress installation.
3. Activate the WP Simple Megamenu from your Plugins page.

## Usage

1. After installing and activating this plugin, goto Settings -> Simple Megamenu of your WordPress admin. Select a nav menu registered by your theme, where you want to display the megamenu.
2. Go to Appearance -> Menus in your wordpress admin. Arrange your menu item as you ussually do without the plugin.
3. When you expand any menu item, you'll see the custom fields added here (see [screenshots](#screenshots)). You can see **Activate Megamenu**, **Featured Image** and **Center Title** options.
4. To add a text on your megamenu, you need to activate the **description** text area. It can be done easily by clicking the **screen options** at the upper right corner on the menu setting page. Then just simply check the **description** option under **Show advanced menu properties**.
5. You only allowed to activate the megamenu option for the menu item which has the depth of 0, that is the menu item which has no parent item. The option will be disabled once you move the menu item under another menu item.
6. Save your menu and your normal menu will be displayed as a megamenu on your frontend page (see [screenshots](#screenshots)).

#### Activate Megamenu Option

- Check the **Activate Megamenu** checkbox.
- This option will be disabled once the menu item is moved under another menu item (see [screenshots](#screenshots)).

#### Using Featured Image

- By checking the **Featured Image** checkbox, the link to your selected page will turn into an image menu.
- You need to set the featured image for your page as prerequisite.

#### Centering Page Title

- You might want the page title centered below the featured image menu item. This can be easily done by checking the **Center Title** checkbox.

### Screenshots

Menu on frontend of your website:

![Menu on frontend of your website](/screenshots/megamenu.gif?raw=true)

List items menu:

![List items menu](/screenshots/screenshot-1.png?raw=true)

Texts and images menu:

![Texts and images menu](/screenshots/screenshot-2.png?raw=true)

Dropdown menu:

![Dropdown menu](/screenshots/screenshot-3.png?raw=true)

Megamenu location setting:

![Megamenu location setting](/screenshots/screenshot-4.png?raw=true)

Custom fields added under Appearance -> Menus to control the appearance of your megamenu:

![Custom fields added under Appearance -> Menus](/screenshots/screenshots-5.png?raw=true)

Megamenu option will be disabled once the menu item is moved under another menu item:

![Megamenu option will be disabled once the menu item is moved under another menu item](/screenshots/megamenu-admin.gif?raw=true)

## Contribute

### Reporting a bug 🐞

Before creating a new issue, do browse through the [existing issues](https://github.com/prabuwardhana/wp-simple-megamenu/issues) for resolution or upcoming fixes.

If you still need to [log an issue](https://github.com/prabuwardhana/wp-simple-megamenu/issues/new), making sure to include as much detail as you can, including clear steps to reproduce your issue if possible.

### Creating a pull request

Want to contribute a new feature? Start a conversation by logging an [issue](https://github.com/prabuwardhana/wp-simple-megamenu/issues).

Once you're ready to send a pull request, please run through the following checklist:

1. Browse through the [existing issues](https://github.com/prabuwardhana/wp-simple-megamenu/issues) for anything related to what you want to work on. If you don't find any related issues, open a new one.

1. Fork this repository.

1. Create a branch from `development` for each issue you'd like to address and commit your changes.

1. Push the code changes from your local clone to your fork.

1. Open a pull request and that's it! I'll give feedback as soon as possible (Isn't collaboration a great thing? 😌)

1. Once your pull request has passed final code review and tests, it will be merged into `development` and be in the pipeline for the next release. Props to you! 🎉
