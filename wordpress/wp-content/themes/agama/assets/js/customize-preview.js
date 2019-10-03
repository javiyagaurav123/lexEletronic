/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

( function( $ ) {
    
    var layout = _AgamaPreviewData.layout_style;
    
    // Site Title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
    
    // Site Description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
    
    // Layout Style
    wp.customize( 'agama_layout_style', function( value ) {
        value.bind( function( to ) {
            if( 'fullwidth' === to ) {
                $('#agama-main-wrapper').removeClass( 'tv-container tv-p-0' ).addClass( 'is-full-width' );
            } else if( 'boxed' === to ) {
                $('#agama-main-wrapper').removeClass( 'is-full-width' ).addClass( 'tv-container tv-p-0' );
            }
        } );
    } );
    
    // Add New Widget
    $(".add-new-widget").on("click", function(e) {
        e.preventDefault();
        var ID = $(this).parent().attr("data-id");
        wp.customize.preview.send("focus-on-widget", ID);
    });
    
})( jQuery );
