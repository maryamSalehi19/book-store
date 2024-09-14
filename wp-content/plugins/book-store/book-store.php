<?php
/*
Plugin Name: Book Store
Description: Your custom book store functionality.
Version: 1.0
Author: Your Name
*/

function create_books_info_table($wpdb) {
    $table_name = $wpdb->prefix . 'books_info';

    $sql = "CREATE TABLE $table_name (
        ID INT NOT NULL AUTO_INCREMENT,
        post_id INT NOT NULL,
        isbn VARCHAR(20) NOT NULL,
        PRIMARY KEY (ID)
    ) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci"; 

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

register_activation_hook(__FILE__, function() use ($wpdb) {
    create_books_info_table($wpdb);
});

?>
