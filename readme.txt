=== Plugin Name ===
Contributors: DonnieAllenCooper, nathandidier
Donate link: 
Tags: google adwords, adwords, ppc, call-tracking, tracking
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 1.2

Display a different phone number accross your website for Google Adwords visitors. 

== Description ==

Display a different phone number accross your website for Google Adwords visitors. The Google Adwords Call Tracking Plugin works by setting a cookie if a visitor has come to your website from an Adwords Campaign. Each time the visitor comes back to your website, your Adwords phone number will still be shown if the cookie has not expired. You can set the cookie to expire (in seconds) from when the user either first or last visited your website.

To use: Simply enter the shortcode [adwords_phone] (in place of a phone number) anywhere throughout your content in wordpress pages, posts or widgets.
NOTE: You must enable the use of shortcodes for widgets in functions.php.

Developer Note: Developers can use the custom php function adwords_phone($adwords_number, $regular_number) for use in theme files.
Where $adwords_number and $regular_number are the contents to be displayed (or actions to be taken) if the cookie is not expired. Please note: the function returns the  value so you will need to echo or print it out.

For more information about this plugin, please visit our Google Adwords Call Tracking post... http://scientificroi.org/blog/google-adwords-call-tracking-wordpress-plugin.
If you have any questions, suggestions or just have nice things to say... please let us know... @scientificroi

== Installation ==

1. Upload `google-adwords-call-tracking` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
2. Configure "Adwords Number" in the "Settings" menu
3. Place `[adwords_phone]` in your pages, posts and widgets.... 
4. And/or use the php function 'adwords_phone($adwords_number, $regular_number);' in your theme files
5. Enjoy knowing how many phone calls Google Adwords is responsible for!

== Frequently Asked Questions ==

= no questions yet... =

...so no answers yet...

== Screenshots ==

1. /tags/1.0/screenshot-1.jpg`

