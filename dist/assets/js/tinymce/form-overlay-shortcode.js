"use strict";!function(e){function o(e){var o=[];for(var a in e)o.push({text:e[a],value:a});return o}e(document).ready(function(){tinymce.PluginManager.add("form_overlay_shortcode_script",function(e,a){e.addButton("form_overlay_shortcode",{text:kwaske_tinymce_l10n.form_overlay_shortcode.tinymce_title,icon:!1,onclick:function(){e.windowManager.open({title:kwaske_tinymce_l10n.form_overlay_shortcode.tinymce_title,body:[{type:"listbox",name:"form_id",label:kwaske_tinymce_l10n.form_overlay_shortcode.form_id.label,values:o(kwaske_tinymce_l10n.form_overlay_shortcode.form_id.choices)},{type:"textbox",name:"text",label:kwaske_tinymce_l10n.form_overlay_shortcode.button_text.label},{type:"listbox",name:"color",label:kwaske_tinymce_l10n.form_overlay_shortcode.colors.label,values:o(kwaske_tinymce_l10n.form_overlay_shortcode.colors.choices),value:kwaske_tinymce_l10n.form_overlay_shortcode.colors["default"]},{type:"listbox",name:"size",label:kwaske_tinymce_l10n.form_overlay_shortcode.size.label,values:o(kwaske_tinymce_l10n.form_overlay_shortcode.size.choices)},{type:"checkbox",name:"hollow",label:kwaske_tinymce_l10n.form_overlay_shortcode.hollow.label},{type:"checkbox",name:"expand",label:kwaske_tinymce_l10n.form_overlay_shortcode.expand.label}],onsubmit:function(o){e.insertContent("[form_overlay"+(void 0!==o.data.form_id?' form_id="'+o.data.form_id+'"':"")+(void 0!==o.data.color?' color="'+o.data.color+'"':"")+(void 0!==o.data.size&&""!==o.data.size?' size="'+o.data.size+'"':"")+(void 0!==o.data.hollow&&o.data.hollow!==!1?' hollow="'+o.data.hollow+'"':"")+(void 0!==o.data.expand&&o.data.expand!==!1?' expand="'+o.data.expand+'"':"")+"]"+(void 0!==o.data.text?o.data.text:"")+"[/form_overlay]")}})}})})})}(jQuery);