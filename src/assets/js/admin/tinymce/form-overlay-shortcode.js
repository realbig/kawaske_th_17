( function( $ ) {
    
    /**
     * Take our Localized Choices and turn them into something TinyMCE Listbox understands
     * 
     * @param       {object} choices Choices Object from our Localized JSON
     *                               
     * @since       1.0.1
     * @returns     {Array}  Array of TinyMCE Listbox Choices
     */
    function kwaske_generate_tinymce_listbox( choices ) {

        var result = [];
        
        for ( var key in choices ) {
            
            result.push( {
                text: choices[key],
                value: key
            } );
            
        }
        
        return result;
        
    }

    $( document ).ready( function() {
        
        tinymce.PluginManager.add( 'form_overlay_shortcode_script', function( editor, url ) {
            editor.addButton( 'form_overlay_shortcode', {
                text: kwaske_tinymce_l10n.form_overlay_shortcode.tinymce_title,
                icon: false,
                onclick: function() {
                    editor.windowManager.open( {
                        title: kwaske_tinymce_l10n.form_overlay_shortcode.tinymce_title,
                        body: [
							{
								type: 'listbox',
								name: 'form_id',
								label: kwaske_tinymce_l10n.form_overlay_shortcode.form_id.label,
								values: kwaske_generate_tinymce_listbox( kwaske_tinymce_l10n.form_overlay_shortcode.form_id.choices ),
							},
                            {
                                type: 'textbox',
                                name: 'text',
                                label: kwaske_tinymce_l10n.form_overlay_shortcode.button_text.label,
                            },
                            {
                                type: 'listbox',
                                name: 'color',
                                label: kwaske_tinymce_l10n.form_overlay_shortcode.colors.label,
                                values: kwaske_generate_tinymce_listbox( kwaske_tinymce_l10n.form_overlay_shortcode.colors.choices ),
                                value: kwaske_tinymce_l10n.form_overlay_shortcode.colors.default,
                            },
                            {
                                type: 'listbox',
                                name: 'size',
                                label: kwaske_tinymce_l10n.form_overlay_shortcode.size.label,
                                values: kwaske_generate_tinymce_listbox( kwaske_tinymce_l10n.form_overlay_shortcode.size.choices ),
                            },
                            {
                                type: 'checkbox',
                                name: 'hollow',
                                label: kwaske_tinymce_l10n.form_overlay_shortcode.hollow.label,
                            },
                            {
                                type: 'checkbox',
                                name: 'expand',
                                label: kwaske_tinymce_l10n.form_overlay_shortcode.expand.label,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[form_overlay' + 
												 	 ( e.data.form_id !== undefined ? ' form_id="' + e.data.form_id + '"' : '' ) + 
                                                     ( e.data.color !== undefined ? ' color="' + e.data.color + '"' : '' ) + 
                                                     ( e.data.size !== undefined && e.data.size !== '' ? ' size="' + e.data.size + '"' : '' ) + 
                                                     ( e.data.hollow !== undefined && e.data.hollow !== false ? ' hollow="' + e.data.hollow + '"' : '' ) + 
                                                     ( e.data.expand !== undefined && e.data.expand !== false ? ' expand="' + e.data.expand + '"' : '' ) + 
                                                 ']' + 
                                                     ( e.data.text !== undefined ? e.data.text : '' ) + 
                                                 '[/form_overlay]' );
                        }

                    } ); // Editor

                } // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );