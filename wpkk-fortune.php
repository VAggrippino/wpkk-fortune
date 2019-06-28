<?php
/*
Plugin Name: Fortune for WordPress KK
Plugin URI: https://www.aggrippino.com/wordpress-plugins/wpkk-fortune
Description: Retrieve a random fortune from a free online API.
Version: 1.0.0
Author: Vince Aggrippino
Author URI: https://www.aggrippino.com
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

function wpkk_fortune() {
	$json = file_get_contents('http://yerkee.com/api/fortune');
	$fortune = json_decode($json)->{'fortune'};
	printf(
		'<div class="wpkk-fortune"><p class="wpkk-fortune--content">%s</p></div>',
		$fortune
  );
}

function wpkk_fortune_css() {
	echo "
	<style>
		.wpkk-fortune {
			position: fixed;
			bottom: 0;
			right: 0;
		}

		.wpkk-fortune--content {
			background-color: beige;
			color: black;
			margin: 0;
			padding: 0.25em 0.5em;
			max-width: 15em;
			max-height: 3.6rem;
			line-height: 1.2rem;
			font-size: 1rem;
			overflow: auto;
			border: 1px outset gray;
			border-top-left-radius: 0.25em;
		}
	</style>
	";
}

// Insert the CSS into the admin page <head>
add_action('admin_head', 'wpkk_fortune_css');

// Insert the CSS into the <head> of other pages, too
add_action('wp_head', 'wpkk_fortune_head');

// Show the fortune at the bottom of admin pages
add_action('admin_footer', 'wpkk_fortune');

// Show the fortune at the bottom of other WordPress pages, too
add_action('wp_footer', 'wpkk_fortune');
