<?php
/**
 * Theme back compat functionality
 *
 * Prevents this theme from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 */

/**
 * Prevent switching to this theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 */
function northeast_on_switch_theme() {
    switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', 'northeast_theme_upgrade_notice' );
}
add_action( 'after_switch_theme', 'northeast_on_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * this theme on WordPress versions prior to 4.2.
 *
 */
function northeast_theme_upgrade_notice() {
    $message = sprintf( __( 'This theme requires at least WordPress version 4.2. You are running version %s. Please upgrade and try again.', 'north-east' ), $GLOBALS['wp_version'] );
    printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.2.
 */
function northeast_theme_customize() {
    wp_die( sprintf( __( 'This theme requires at least WordPress version 4.2. You are running version %s. Please upgrade and try again.', 'north-east' ), $GLOBALS['wp_version'] ), '', array(
        'back_link' => true,
    ) );
}
add_action( 'load-customize.php', 'northeast_theme_customize' );

/**
 * Prevent the theme from being loaded on WordPress versions prior to 4.2.
 */
function northeast_theme_preview() {
    if ( isset( $_GET['preview'] ) ) {
        wp_die( sprintf( __( 'This theme requires at least WordPress version 4.2. You are running version %s. Please upgrade and try again.', 'north-east' ), $GLOBALS['wp_version'] ) );
    }
}
add_action( 'template_redirect', 'northeast_theme_preview' );
