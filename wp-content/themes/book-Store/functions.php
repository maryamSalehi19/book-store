<?
function create_book_post_type($args) {
	// Register the Book post type
	register_post_type('book', $args);
}

// Labels for the Book post type
$labels = array(
	'name' => __('Books'),
	'singular_name' => __('Book'),
	'menu_name' => __('Books'),
	'name_admin_bar' => __('Book'),
	'add_new' => __('Add New'),
	'add_new_item' => __('Add New Book'),
	'new_item' => __('New Book'),
	'edit_item' => __('Edit Book'),
	'view_item' => __('View Book'),
	'all_items' => __('All Books'),
	'search_items' => __('Search Books'),
	'not_found' => __('No books found.'),
	'not_found_in_trash' => __('No books found in Trash.')
);

// Arguments for the Book post type
$args = array(
	'labels' => $labels,
	'public' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
	'show_in_rest' => true,
);

// Injecting dependencies
create_book_post_type($args);

//Taxonomy
function create_book_taxonomies($args_publisher,$args_authors) {
	// Register the Publisher taxonomy
	register_taxonomy('publisher', array('book'), $args_publisher);

	// Register the Author taxonomy
	register_taxonomy('author', array('book'), $args_authors);
}

// Labels for the Publisher taxonomy
$labels_publisher = array(
	'name' => __('Publishers'),
	'singular_name' => __('Publisher'),
	'search_items' => __('Search Publishers'),
	'all_items' => __('All Publishers'),
	'edit_item' => __('Edit Publisher'),
	'update_item' => __('Update Publisher'),
	'add_new_item' => __('Add New Publisher'),
	'new_item_name' => __('New Publisher Name'),
	'menu_name' => __('Publishers'),
);

// Arguments for the Publisher taxonomy
$args_publisher = array(
	'hierarchical' => true,
	'labels' => $labels_publisher,
	'show_ui' => true,
	'show_admin_column' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'publisher'),
);

// Labels for the Author taxonomy
$labels_authors = array(
	'name' => __('Authors'),
	'singular_name' => __('Author'),
	'search_items' => __('Search Authors'),
	'all_items' => __('All Authors'),
	'edit_item' => __('Edit Author'),
	'update_item' => __('Update Author'),
	'add_new_item' => __('Add New Author'),
	'new_item_name' => __('New Author Name'),
	'menu_name' => __('Authors'),
);

// Arguments for the Author taxonomy
$args_authors = array(
	'hierarchical' => false,
	'labels' => $labels_authors,
	'show_ui' => true,
	'show_admin_column' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'author'),
);

// Injecting dependencies
create_book_taxonomies($args_publisher, $args_authors);


//Create mete-box for ISBN
function add_book_meta_box() {
	add_meta_box(
			'book_meta_box', 
			'ISBN',
			'display_book_meta_box',
			'book', 
			'normal', 
			'high' 
	);
}
// Hook into the 'add_meta_boxes' action
add_action('add_meta_boxes', 'add_book_meta_box');

// //Show meta-box 
function display_book_meta_box($post) {
	wp_nonce_field('save_book_meta_box', 'book_meta_box_nonce');
	$isbn = get_post_meta($post->ID, 'isbn', true);
	?>
	<label for="isbn">ISBN:</label>
	<input type="text" name="isbn" value="<?php echo esc_attr($isbn); ?>" />
	<?php
}

//Store isbn in book_info table
function save_book_meta_box($post_id) {
	if (array_key_exists('isbn', $_POST)) {
			$isbn = sanitize_text_field($_POST['isbn']);
			update_post_meta($post_id, 'isbn', $isbn);

			global $wpdb;
			$table_name = $wpdb->prefix . 'books_info';

			$existing = $wpdb->get_var($wpdb->prepare(
					"SELECT COUNT(*) FROM $table_name WHERE post_id = %d",
					$post_id
			));

			if ($existing) {
					$wpdb->update(
							$table_name,
							array('isbn' => $isbn),
							array('post_id' => $post_id),
							array('%s'),
							array('%d')
					);
			} else {
					$wpdb->insert(
							$table_name,
							array(
									'post_id' => $post_id,
									'isbn' => $isbn
							),
							array(
									'%d',
									'%s'
							)
					);
			}
	}
}
add_action('save_post', 'save_book_meta_box');

// // Creatr book-info Menu
function custom_book_info_menu() {
	add_menu_page(
			'Book Info',
			'Book Info', 
			'manage_options',
			'book-info', 
			'display_book_info_page',
			'dashicons-book',
			6 
	);
}
add_action('admin_menu', 'custom_book_info_menu');


// WP_List_Table is not loaded automatically so we need to load it in our application
if (!class_exists('WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

//Create a new table class that will extend the WP_List_Table
class Book_Info_List_Table extends WP_List_Table {

	// Creatin table columns
	function get_columns() {
		return [
			'ID'      => 'ID',
			'post_id' => 'Post ID',
			'isbn'    => 'ISBN'
		];
	}

	// get information from the database
	function prepare_items() {
		global $wpdb;
		$data = $wpdb->get_results("SELECT * FROM bookStore.ps_books_info", ARRAY_A);

		$this->_column_headers = [$this->get_columns(), [], $this->get_sortable_columns()];
		$this->items = $data;
	}

	//Placement of each data in the corresponding column
	function column_default($item, $column_name) {
		return $item[$column_name] ?? print_r($item, true);
	}
}

// //Show information in book_info
function display_book_info_page() {
	$bookListTable = new Book_Info_List_Table();
	$bookListTable->prepare_items();

	echo '<div class="wrap">';
	echo '<h1>Book Info</h1>';
	$bookListTable->display();
	echo '</div>';
}