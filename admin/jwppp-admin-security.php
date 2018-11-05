<?php
/**
 * Secure video URLs and player embeds
 * @author ilGhera
 * @package jw-player-7-for-wp/admin
 * @version 1.6.0
 */
?>
<div name="jwppp-security" id="jwppp-security" class="jwppp-admin" style="display: none;">
	<?php

	/*Secure video URLs*/
	$secure_video_urls = sanitize_text_field(get_option('jwppp-secure-video-urls'));
	if(isset($_POST['security-sent']) ) {
		// $hide = isset($_POST['jwppp-secure-video-urls']) ? ' style="display: none;"' : '';
		$secure_video_urls = isset($_POST['jwppp-secure-video-urls']) ? sanitize_text_field($_POST['jwppp-secure-video-urls']) : 0;
		update_option('jwppp-secure-video-urls', $secure_video_urls);
	}

	/*Secure player embeds*/
	$secure_player_embeds = sanitize_text_field(get_option('jwppp-secure-player-embeds'));
	if(isset($_POST['security-sent']) ) {
		// $hide = isset($_POST['jwppp-secure-player-embeds']) ? ' style="display: none;"' : '';
		$secure_player_embeds = isset($_POST['jwppp-secure-player-embeds']) ? sanitize_text_field($_POST['jwppp-secure-player-embeds']) : 0;
		update_option('jwppp-secure-player-embeds', $secure_player_embeds);
	}

	/*Timeout*/
	$secure_timeout = get_option('jwppp-secure-timeout') ? sanitize_text_field(get_option('jwppp-secure-timeout')) : 60;
	if(isset($_POST['security-sent']) ) {
		// $hide = isset($_POST['jwppp-secure-timeout']) ? ' style="display: none;"' : '';
		$secure_timeout = isset($_POST['jwppp-secure-timeout']) ? sanitize_text_field($_POST['jwppp-secure-timeout']) : 0;
		update_option('jwppp-secure-timeout', $secure_timeout);
	}

	/*Define the allowed tags for wp_kses*/
	$allowed_tags = array(
		'u' => [],
		'strong' => [],
		'a' => [
			'href'   => [],
			'target' => []
		],
		'br' => []
	);

	echo '<form id="jwppp-security" name="jwppp-security" method="post" action="">';
	echo '<table class="form-table">';

	/*Secure video URLs*/
	echo '<tr>';
	echo '<th scope="row">' . esc_html(__('Secure Video URLs', 'jwppp')) . '</th>';
	echo '<td>';
	echo '<label>';
	echo '<input type="checkbox" id="jwppp-secure-video-urls" name="jwppp-secure-video-urls" value="1"';
	echo ($secure_video_urls === '1') ? ' checked="checked"' : '';
	echo ' />';
	echo wp_kses(__('Protect your contents with signed URLs.', 'jwppp'), $allowed_tags);
	echo '</label>';
	echo '<p class="description">' . wp_kses(__('Option must be activated in the dashboard. <a href="https://support.jwplayer.com/articles/how-to-enable-url-token-signing">Read more</a>.', 'jwppp'), $allowed_tags) . '</p>';
	echo '<td>';
	echo '</tr>';

	/*Secure player embeds*/
	echo '<tr>';
	echo '<th scope="row">' . esc_html(__('Secure Player Embeds', 'jwppp')) . '</th>';
	echo '<td>';
	echo '<label>';
	echo '<input type="checkbox" id="jwppp-secure-player-embeds" name="jwppp-secure-player-embeds" value="1"';
	echo ($secure_player_embeds === '1') ? ' checked="checked"' : '';
	echo ' />';
	echo wp_kses(__('Lock down embedding of your players.', 'jwppp'), $allowed_tags);
	echo '</label>';
	echo '<p class="description">' . wp_kses(__('Option must be activated in the dashboard. <a href="https://support.jwplayer.com/articles/how-to-enable-url-token-signing" target="_blank">Read more</a>.', 'jwppp'), $allowed_tags) . '</p>';
	echo '<td>';
	echo '</tr>';

	/*Secure timeout*/
	echo '<tr>';
	echo '<th scope="row">' . esc_html(__('Set timeout', 'jwppp')) . '</th>';
	echo '<td>';
	echo '<input type="number" id="jwppp-secure-timeout" name="jwppp-secure-timeout" step="5" min="5" value="' . $secure_timeout . '" />';
	echo '<p class="description">' . wp_kses(__('The timeout in minutes.', 'jwppp'), $allowed_tags) . '</p>';
	echo '<td>';
	echo '</tr>';

	echo '</table>';

	echo '<input type="hidden" name="security-sent" value="1" />';
	echo '<input class="button button-primary" type="submit" id="submit" value="' . esc_html(__('Save options', 'jwppp')) . '" />';
	echo '</form>';
	?>
</div>