=== Plugin Name ===
Contributors: donnie-cooper, nathandidier
Donate link: 
Tags: comments, spam
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 1.0

Display a different phone number accross your website for Google Adwords visitors. 

== Description ==

The Google Adwords Call Tracking Plugin works by setting a cookie if a visitor has come to your website from an Adwords Campaign.
Each time the visitor comes back to your website, your Adwords phone number will still be shown if the cookie has not expired.
You can set the cookie to expire (in seconds) from when the user either first or last visited your website.

To use: Simply enter the shortcode [adwords_phone] (in place of a phone number) anywhere throughout your content in wordpress pages, posts or widgets.
NOTE: You must enable the use of shortcodes for widgets in functions.php.

Developer Note: Developers can use the custom php function adwords_phone($adwords_number, $regular_number) for use in theme files.
Where $adwords_number and $regular_number are the contents to be displayed (or actions to be taken) if the cookie is not expired.

For more information about this plugin, please visit our Google Adwords Call Tracking Wordpress Plugin page.
If you have any questions, suggestions or just have nice things to say... please email us at info@scientificroi.org.

== Installation ==

1. Upload `google-adwords-call-tracking` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
2. Configure "Adwords Number" in the "Settings" menu
3. Place `[adwords_phone]` in your pages, posts and widgets.... 
4. And/or use '<?php adwords_phone($adwords_number, Regular_number); ?>' in your theme files
5. Enjoy knowing how many phone calls Google Adwords is responsible for!

== Frequently Asked Questions ==

= no questions yet... =

...so no answers yet...

== Screenshots ==

1. /tags/1.0/screenshot-1.jpg`
2. http://scientificroi.org/images/google-adwords-call-tracking.jpg

== Changelog ==

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
