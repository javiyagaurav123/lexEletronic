<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Select Sidebar, Header Featured Image Options, Single Page/Post Image
 * This is only for the design purpose and not used to save any content
 *
 * @package Bold_Photography
 */



/**
 * Class to Renders and save metabox options
 *
 * @since Bold Photography 1.0
 */
class Bold_Photography_Metabox {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* @since Bold Photography 1.0
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
							'id'        => $meta_box_id,
							'title'     => $meta_box_title,
							'post_type' => $post_type,
							);

		$this->fields = array(
			'bold-photography-header-image'
		);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	* Add Meta Box for multiple post types.
	*
	* @since Bold Photography 1.0
	*
	* @access public
	*/
	public function add( $post_type ) {
		add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $post_type, 'side', 'high' );
	}

	/**
	* Renders metabox
	*
	* @since Bold Photography 1.0
	*
	* @access public
	*/
	public function show() {
		global $post;
		$header_image_options = array(
			'default' => esc_html__( 'Default', 'bold-photography' ),
			'enable'  => esc_html__( 'Enable', 'bold-photography' ),
			'disable' => esc_html__( 'Disable', 'bold-photography' ),
		);

		// Use nonce for verification
		wp_nonce_field( basename( __FILE__ ), 'bold_photography_custom_meta_box_nonce' ); ?>


		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="bold-photography-header-image"><?php esc_html_e( 'Header Featured Image Options', 'bold-photography' ); ?></label></p>
		<select class="widefat" name="bold-photography-header-image" id="bold-photography-header-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'bold-photography-header-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value='default';
				}
				
				foreach ( $header_image_options as $field =>$label ) {	
				?>
					<option value="<?php echo esc_attr( $field ); ?>" <?php selected( $meta_value, $field ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
				} // end foreach
			?>
		</select>
		<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * @since Bold Photography 1.0
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
		|| ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
		|| ( ! check_admin_referer( basename( __FILE__ ), 'bold_photography_custom_meta_box_nonce') )    // Check nonce - Security
		|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
		{
		  return $post_id;
		}

		foreach ( $this->fields as $field ) {
			$new = $_POST[ $field ];

			delete_post_meta( $post_id, $field );

			if ( '' == $new || array() == $new ) {
				return;
			} else {
				if ( ! update_post_meta ( $post_id, $field, sanitize_key( $new ) ) ) {
					add_post_meta( $post_id, $field, sanitize_key( $new ), true );
				}
			}
		} // end foreach
	}
}

$bold_photography_metabox = new Bold_Photography_Metabox(
	'bold-photography-options',                  //metabox id
	esc_html__( 'Bold Photography Options', 'bold-photography' ), //metabox title
	array( 'page', 'post' )             //metabox post types
);
