<?php
/*
Plugin Name: Google Adwords Call Tracking
Plugin URI: http://scientificroi.org/blog/google-adwords-call-tracking-wordpress-plugin
Description: Display a different phone number accross your website for Google Adwords visitors. Please configure "Adwords Number" under 'Settings".
Version: 1.0 
Author: ScientificROI.org
Author URI: http://www.scientificroi.org
*/

/*
Google Adwords Call Tracking (Wordpress Plugin)
Copyright (C) 2011 ScientificROI.org
Contact me at http://www.scientificroi.org

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/




/* = adwordsphone_handler() 
--------------------------------------------------------------------------------------------------------------- */

function adwordsphone_handler() {
  //run function that actually does the work of the plugin
  $adwordsphone_output = adwordsphone_function();
  //send back text to replace shortcode in post
  return $adwordsphone_output;
}

/* ---------------------------------------------------------------------------------------------------------------
=/ adwordsphone_handler()  */






/* =  set variables
--------------------------------------------------------------------------------------------------------------- */

$adwords_cookie_name = 'gact_wp';
$adwords_cookie = $_COOKIE[$adwords_cookie_name];
$adwords_parameter = $_GET['gclid'];
$adwords_number = esc_attr(get_option('adwords_number'));
$regular_number = esc_attr(get_option('regular_number'));
$cookie_seconds = esc_attr(get_option('cookie_seconds'));
$cookie_date = esc_attr(get_option('cookie_date'));

/* ---------------------------------------------------------------------------------------------------------------
=/ set variables  */




/* = set adwords cookie  
--------------------------------------------------------------------------------------------------------------- */

// decide if cookie date should use first or last
function cookie_expiration() {
// pull in global variables
	global $adwords_cookie;
	global $cookie_seconds;
	global $cookie_date;

// decide to use first cookie date or last cookie date
	if($cookie_date == 'first') { $cookie_expiration = $adwords_cookie + $cookie_seconds;} 
	else { $cookie_expiration = time() + $cookie_seconds;}
	return $cookie_expiration;
}

// if custom adwords cookie is NOT set
if (!isset($adwords_cookie)) {
	// if url parameter contains ppc data
	if (isset($adwords_parameter)) { 
		// set cookie to expire in 90 days
		setcookie($adwords_cookie_name, time(), time()+$cookie_seconds);
	}
}
// if custom adwords cookie IS set
elseif (isset($adwords_cookie)) {
	// update the value and the seconds
	setcookie($adwords_cookie_name, $adwords_cookie, cookie_expiration());
}

/* ---------------------------------------------------------------------------------------------------------------
=/ set adwords cookie   */





/* = [SHORTCODE] adwords_phone_shortcut (NOT USED)
--------------------------------------------------------------------------------------------------------------- */
// echo do_shortcode('[adwords_phone adwords="555-555-5555" regular="444-444-4444"]'); 

function adwords_phone_shortcut($atts) {
// pull in global variables
	global $adwords_cookie;
	global $adwords_parameter;
	global $adwords_number;
	global $regular_number;
	
//process plugin
  	// set parameters and set default values
	$attributes = array( 'adwords' => $adwords_number, 'regular' => $regular_number, ); 
	
	// extract values from shortcode
	extract(shortcode_atts($attributes, $atts));
	
	// if custom adwords cookie is set
	if (isset($adwords_cookie)) {
		$adwordsphone_output = "{$adwords}";
	}
	// if url parameter contains ppc data
	elseif (isset($adwords_parameter)) {
		$adwordsphone_output = "{$adwords}";
	}
	else {
		$adwordsphone_output = "{$regular}";
	}
  //send back text to calling function
  return $adwordsphone_output;
}

//tell wordpress to register the demolistposts shortcode
add_shortcode('adwords_phone', 'adwords_phone_shortcut');

/* ---------------------------------------------------------------------------------------------------------------
=/[SHORTCODE] adwords_phone_shortcut (NOT USED) */





/* = adwords_phone() (option for use in theme files)
--------------------------------------------------------------------------------------------------------------- */

function adwords_phone($adwords_number, $regular_number) {
// pull in global variables
	global $adwords_cookie;
	global $adwords_parameter;
	global $adwords_number;
	global $regular_number;
	
// if custom adwords cookie is set
	if (isset($adwords_cookie)) {
		return $adwords_number;
	}
	elseif (isset($adwords_parameter)) {
		return $adwords_number;
	}
	else {
		return $regular_number;
	}
}

/* ---------------------------------------------------------------------------------------------------------------
=/ adwords_phone() (option for use in theme files) */





/* = options interface 
--------------------------------------------------------------------------------------------------------------- */

// initialize adwords number
function adwords_number_init() {
	register_setting('adwords_number_options','adwords_number');
}
add_action('admin_init','adwords_number_init');

// initialize regular number
function regular_number_init() {
	register_setting('regular_number_options','regular_number');
}
add_action('admin_init','regular_number_init');

// initialize cookie seconds
function cookie_seconds_init() {
	register_setting('cookie_seconds_options','cookie_seconds');
}
add_action('admin_init','cookie_seconds_init');

// initialize cookie date
function cookie_date_init() {
	register_setting('cookie_date_options','cookie_date');
}
add_action('admin_init','cookie_date_init');


function adwords_phone_option_page() { 
// pull in global variables
	global $adwords_number;
	global $regular_number;
	global $cookie_seconds;
	global $cookie_date;

// build admin interface
	?><div class"dwords-wrap">
    <?php screen_icon();?>
    <h2>Google Adwords Call Tracking Wordpress Plugin</h2>
    <p>PLEASE NOTE: You're Adwords Campaign MUST have <a target="_blank" href="http://adwords.google.com/support/aw/bin/answer.py?hl=en&answer=55596">auto tagging</a> enabled for this plugin to work.</p>
    <p>The Google Adwords Call Tracking Plugin works by setting a cookie if a visitor has come to your website from an Adwords Campaign.<br />Each time the visitor comes back to your website, your Adwords phone number will still be shown if the cookie has not expired.<br />You can set the cookie to expire (in seconds) from when the user either first or last visited your website.</p>
    <p>To use: Simply enter the shortcode [adwords_phone] (in place of a phone number) anywhere throughout your content in wordpress pages, posts or widgets.<br /> NOTE: You must <a target="_blank" href="http://www.wprecipes.com/how-to-add-shortcodes-in-sidebar-widgets">enable the use of shortcodes for widgets</a> in functions.php.</p>
    <p>Developer Note: Developers can use the custom php function adwords_phone($adwords_number, $regular_number) for use in theme files.<br /> Where $adwords_number and $regular_number are the contents to be displayed (or actions to be taken) if the cookie is not expired.</p>
    <p>For more information about this plugin, please visit our <a target+"_blank" href="http://scientificroi.org/blog/google-adwords-call-tracking-wordpress-plugin">Google Adwords Call Tracking Wordpress Plugin</a> page.<br /> If you have any questions, suggestions or just have nice things to say... please email us at info@scientificroi.org.</p>
    <hr />
    <br /><br />
    <p><h3 style="display:inline;">#1 </h3>Please enter the phone number you want to show for Google Adwords visitors...</p>
    <form action="options.php" method="post" id="adwords-number-options-form"><?php settings_fields('adwords_number_options'); ?>
    <h4><label for="adwords_number">Adwords Number: </label> 
    <input type="text" id="adwords_number" name="adwords_number" value="<?php echo $adwords_number;; ?>" />
    <input type="submit" name="submit" value="Update Adwords Number" /></h4></form>
    <br /><br />
    <p><h3 style="display:inline;">#2 </h3>Please enter the phone number you want to show for NON Google Adwords visitors...</p>
    <form action="options.php" method="post" id="regular-number-options-form"><?php settings_fields('regular_number_options'); ?>
    <h4><label for="regular_number">Regular Number: </label> 
    <input type="text" id="regular_number" name="regular_number" value="<?php echo $regular_number; ?>" />
    <input type="submit" name="submit" value="Update Regular Number" /></h4></form>
    <br /><br />
    <p><h3 style="display:inline;">#3 </h3>Please enter the number of seconds you want the cookie to persist...</p>
    <form action="options.php" method="post" id="cookie-seconds-options-form"><?php settings_fields('cookie_seconds_options'); ?>
    <h4><label for="cookie_seconds">Seconds Cookie Will Last: </label> 
    <input type="text" id="cookie_seconds" name="cookie_seconds" value="<?php echo $cookie_seconds; ?>" />
    <input type="submit" name="submit" value="Update Cookie Seconds" /></h4></form>
    <br /><br />
    <p><h3 style="display:inline;">#4 </h3>Please choose when the number of seconds should be counted from...</p>
    <form action="options.php" method="post" id="cookie-date-options-form"><?php settings_fields('cookie_date_options'); ?>
    <h4><input id="cookie_date" type="radio" value="first" name="cookie_date" <?php global $cookie_date; if($cookie_date == 'first') {echo 'checked';} ?>>First Visit </h4>
    <h4><input id="cookie_date" type="radio" value="last" name="cookie_date" <?php global $cookie_date; if($cookie_date == 'last') {echo 'checked';} ?>>Most Recent Visit </h4>
    <h4><input type="submit" name="submit" value="Update Cookie Date" /></h4></form>
    <br /><br />
    <hr />
    <pre>
 _____ _            _____           _ 
 |_   _| |__   ___  | ____|_ __   __| |
   | | | '_ \ / _ \ |  _| | '_ \ / _` |
   | | | | | |  __/ | |___| | | | (_| |
   |_| |_| |_|\___| |_____|_| |_|\__,_|      
    </pre>
    </div><?php
}

function adwords_plugin_menu() {
	add_options_page('Adwords Number','Adwords Number','manage_options', 'adwords-number-plugin', 'adwords_phone_option_page');
}

add_action('admin_menu','adwords_plugin_menu');

/* ---------------------------------------------------------------------------------------------------------------
=/ options interface   */






?>