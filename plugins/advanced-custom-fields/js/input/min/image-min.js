!function($){var e=acf.media;acf.fields.image={$el:null,$input:null,o:{},set:function(e){return $.extend(this,e),this.$input=this.$el.find('input[type="hidden"]'),this.o=acf.helpers.get_atts(this.$el),this.o.multiple=!!this.$el.closest(".repeater").exists(),this.o.query={type:"image"},"uploadedTo"==this.o.library&&(this.o.query.uploadedTo=acf.o.post_id),this},init:function(){acf.helpers.is_clone_field(this.$input)},add:function(t){var a=e.div;a.find(".acf-image-image").attr("src",t.url),a.find(".acf-image-value").val(t.id).trigger("change"),a.addClass("active"),a.closest(".field").removeClass("error")},new_frame:function(t){return e.div=this.$el,e.clear_frame(),t.states=[],t.states.push(new wp.media.controller.Library({library:wp.media.query(this.o.query),multiple:t.multiple,title:t.title,priority:20,filterable:"all"})),acf.helpers.isset(wp,"media","controller","EditImage")&&t.states.push(new wp.media.controller.EditImage),e.frame=wp.media(t),e.frame.on("content:render:edit-image",function(){var e=this.state().get("image"),t=new wp.media.view.EditImage({model:e,controller:this}).render();this.content.set(t),t.loadEditor()},e.frame),e.frame.on("toolbar:create:select",function(e){e.view=new wp.media.view.Toolbar.Select({text:t.button.text,controller:this})},e.frame),e.frame},edit:function(){var t=this.$input.val();this.new_frame({title:acf.l10n.image.edit,multiple:!1,button:{text:acf.l10n.image.update}}),e.frame.on("open",function(){"browse"!=e.frame.content._mode&&e.frame.content.mode("browse"),e.frame.$el.closest(".media-modal").addClass("acf-media-modal acf-expanded");var a=e.frame.state().get("selection"),i=wp.media.attachment(t);$.isEmptyObject(i.changed)&&i.fetch(),a.add(i)}),e.frame.on("close",function(){e.frame.$el.closest(".media-modal").removeClass("acf-media-modal")}),e.frame.open()},remove:function(){this.$el.find(".acf-image-image").attr("src",""),this.$el.find(".acf-image-value").val("").trigger("change"),this.$el.removeClass("active")},popup:function(){var t=this;return this.new_frame({title:acf.l10n.image.select,multiple:t.o.multiple,button:{text:acf.l10n.image.select}}),e.frame.on("content:activate",function(){var e=null,a=null;try{e=acf.media.frame.content.get().toolbar,a=e.get("filters")}catch(e){}return!!a&&($.each(a.filters,function(e,t){t.props.type="image"}),"uploadedTo"==t.o.library&&(a.$el.find('option[value="uploaded"]').remove(),a.$el.after("<span>"+acf.l10n.image.uploadedTo+"</span>"),$.each(a.filters,function(e,t){t.props.uploadedTo=acf.o.post_id})),a.$el.find("option").each(function(){var e=$(this).attr("value");"uploaded"==e&&"all"==t.o.library||e.indexOf("image")===-1&&$(this).remove()}),void a.$el.val("image").trigger("change"))}),acf.media.frame.on("select",function(){if(selection=e.frame.state().get("selection"),selection){var a=0;selection.each(function(i){if(a++,a>1){var l=e.div.closest("td"),o=l.closest(".row"),r=o.closest(".repeater"),n=l.attr("data-field_key"),s="td .acf-image-uploader:first";n&&(s='td[data-field_key="'+n+'"] .acf-image-uploader'),o.next(".row").exists()||r.find(".add-row-end").trigger("click"),e.div=o.next(".row").find(s)}var c={id:i.id,url:i.attributes.url};i.attributes.sizes&&i.attributes.sizes[t.o.preview_size]&&(c.url=i.attributes.sizes[t.o.preview_size].url),acf.fields.image.add(c)})}}),acf.media.frame.open(),!1},text:{title_add:"Select Image",title_edit:"Edit Image"}},$(document).on("click",".acf-image-uploader .acf-button-edit",function(e){e.preventDefault(),acf.fields.image.set({$el:$(this).closest(".acf-image-uploader")}).edit()}),$(document).on("click",".acf-image-uploader .acf-button-delete",function(e){e.preventDefault(),acf.fields.image.set({$el:$(this).closest(".acf-image-uploader")}).remove()}),$(document).on("click",".acf-image-uploader .add-image",function(e){e.preventDefault(),acf.fields.image.set({$el:$(this).closest(".acf-image-uploader")}).popup()})}(jQuery);