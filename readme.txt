=== bS Post / Page Grid / List ===

Contributors: craftwerk

Requires at least: 4.5
Tested up to: 5.5.1
Requires PHP: 5.6
Stable tag: 1.0.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Post / Page Grid / List for bootScore WordPress Theme, Copyright 2020 Bastian Kreiter.

== Installation ==

1. In your admin panel, go to Plugins > and click the Add New button.
2. Click Upload Plugin and Choose File, then select the Plugin's .zip file. Click Install Now.
3. Click Activate to use your new Plugin right away.

== Usage ==

= Posts =

Use a shortcode like this to display posts in a page:

[post-grid type="post" category="sample-category" order="ASC" orderby="title" posts="12"]

[post-list type="post" category="sample-category, test-category" order="DESC" orderby="date"]

Options:

category: category slug - Multiple categories separated by commas
order: ASC or DESC
orderby: date or title
posts: number of posts to display

= Pages =

Use a shortcode like this to display child pages in a page:

[post-grid type="page" post_parent="413" order="ASC" orderby="title" posts="6"]

[post-grid type="page" post_parent="45" order="DESC" orderby="date"]

Options:

post_parent: ID of your parent page
order: ASC or DESC
orderby: date or title
posts: number of pages to display


== Changelog ==

    = 1.0.0 - May 04 2020 =
    
        * Initial release