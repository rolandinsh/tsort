<?php

/**
  Plugin Name: tSort
  Plugin URI: https://mediabox.lv/wordpress/
  Description: post types
  Version: 1.0.5
  Requires at least: 4.8
  Tested up to: 5.0.3
  Author: Rolands Umbrovskis
  Author URI: https://umbrovskis.com
  License: simplemediacode
  License URI: https://simplemediacode.com/license/gpl/

  Copyright (C) 2019, Rolands Umbrovskis

 */
/*
 * Starting tSort
 */

try {
    new tSort();
} catch (Exception $e) {
    $tsort_debug = 'Caught exception: tSort ' . $e->getMessage() . "\n";

    if (apply_filters('tsort_debug_log', defined('WP_DEBUG_LOG') && WP_DEBUG_LOG)) {
        error_log(print_r(compact('tsort_debug'), true));
    }
}
/*
 * tSort class
 * @since 1.0
 */

class tSort {

    var $vers;
    var $jqsdir;

    public function __construct() {
        $this->vers   = '1.0.5';
        $this->jqsdir = __DIR__;
        add_action('init', array(&$this, 'jqSortable'));
    }

    public function jqSortable() {

        if (!is_admin()) {
            wp_enqueue_script('jquery');
            wp_register_script('jqsortable', plugins_url('/tsort/js/jquery.tablesorter.min.js', $this->jqsdir), ['jquery'], $this->vers, false);
            wp_enqueue_script('jqsortable');
            wp_register_script('tsort', plugins_url('/tsort/tsort.js', $this->jqsdir), ['jqsortable'], $this->vers, false);
            wp_enqueue_script('tsort');

            wp_register_style('jqsortable', plugins_url('/tsort/css/theme.default.min.css', $this->jqsdir), [], $this->vers, true);
            wp_enqueue_style('jqsortable');
        }
    }

}
