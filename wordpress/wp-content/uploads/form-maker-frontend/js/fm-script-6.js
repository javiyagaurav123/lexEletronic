    var fm_currentDate = new Date();
    var FormCurrency_6 = '$';
    var FormPaypalTax_6 = '0';
    var check_submit6 = 0;
    var check_before_submit6 = {};
    var required_fields6 = ["2","3","4","5"];
    var labels_and_ids6 = {"2":"type_textarea","3":"type_date_new","4":"type_textarea","5":"type_textarea","1":"type_submit_reset"};
    var check_regExp_all6 = [];
    var check_paypal_price_min_max6 = [];
    var file_upload_check6 = [];
    var spinner_check6 = [];
    var scrollbox_trigger_point6 = '20';
    var header_image_animation6 = 'none';
    var scrollbox_loading_delay6 = '0';
    var scrollbox_auto_hide6 = '1';
    var inputIds6 = '[]';
	  var form_view_count6 = 0;
     function before_load6() {	
}	
 function before_submit6() {
	 }	
 function before_reset6() {	
}
 function after_submit6() {
  
}
    function onload_js6() {
  jQuery("#button_calendar_3, #fm-calendar-3").click(function() {
    jQuery("#wdform_3_element6").datepicker("show");
  });
  jQuery("#wdform_3_element6").datepicker({
    dateFormat: format_date,
    minDate: "",
    maxDate: "",
    changeMonth: true,
    changeYear: true,
    yearRange: "-100:+50",
    showOtherMonths: true,
    selectOtherMonths: true,
    firstDay: "1",
    beforeShow: function(input, inst) {
      jQuery("#ui-datepicker-div").addClass("fm_datepicker");
    },
    beforeShowDay: function(date) {
      var invalid_dates = "";
      var invalid_dates_finish = [];
      var invalid_dates_start = invalid_dates.split(",");
      var invalid_date_range =[];
      for(var i = 0; i < invalid_dates_start.length; i++ ) {
        invalid_dates_start[i] = invalid_dates_start[i].trim();
        if(invalid_dates_start[i].length < 11 || invalid_dates_start[i].indexOf("-") == -1){
          invalid_dates_finish.push(invalid_dates_start[i]);
        }
        else{
          if(invalid_dates_start[i].indexOf("-") > 4) {
            invalid_date_range.push(invalid_dates_start[i].split("-"));
          }
          else {
            var invalid_date_array = invalid_dates_start[i].split("-");
            var start_invalid_day = invalid_date_array[0] + "-" + invalid_date_array[1] + "-" + invalid_date_array[2];
            var end_invalid_day = invalid_date_array[3] + "-" + invalid_date_array[4] + "-" + invalid_date_array[5];
            invalid_date_range.push([start_invalid_day, end_invalid_day]);
          }
        }
      }
      jQuery.each(invalid_date_range, function( index, value ) {
        for(var d = new Date(value[0]); d <= new Date(value[1]); d.setDate(d.getDate() + 1)) {
          invalid_dates_finish.push(jQuery.datepicker.formatDate(format_date, d));
        }
      });
      var string_days = jQuery.datepicker.formatDate(format_date, date);
      var day = date.getDay();
      return [ invalid_dates_finish.indexOf(string_days) == -1 ];
    }
  });
  var default_date;
  var date_value = jQuery("#wdform_3_element6").val();
  (date_value != "") ? default_date = date_value : default_date = "";
  var format_date = "dd/mm/yy";
  jQuery("#wdform_3_element6").datepicker("option", "dateFormat", format_date);
  if(default_date == "today") {
    jQuery("#wdform_3_element6").datepicker("setDate", new Date());
  }
  else if (default_date.indexOf("d") == -1 && default_date.indexOf("m") == -1 && default_date.indexOf("y") == -1 && default_date.indexOf("w") == -1) {
    jQuery("#wdform_3_element6").datepicker("setDate", default_date);
  }
  else {
    jQuery("#wdform_3_element6").datepicker("setDate", default_date);
  }    }

    function condition_js6() {    }

    function check_js6(id, form_id) {
		if (id != 0) {
			x = jQuery("#" + form_id + "form_view"+id);
		}
		else {
		x = jQuery("#form"+form_id);
		}
		    }

    function onsubmit_js6() {
		
    var disabled_fields = "";
    jQuery("#form6 div[wdid]").each(function() {
      if(jQuery(this).css("display") == "none") {
        disabled_fields += jQuery(this).attr("wdid");
        disabled_fields += ",";
      }
    })
    if(disabled_fields) {
      jQuery("<input type=\"hidden\" name=\"disabled_fields6\" value =\""+disabled_fields+"\" />").appendTo("#form6");
    };    }

	function unset_fields6( values, id, i ) {
		rid = 0;
		if ( i > 0 ) {
			jQuery.each( values, function( k, v ) {
				if ( id == k.split('|')[2] ) {
					rid = k.split('|')[0];
					values[k] = '';
				}
			});
			return unset_fields6(values, rid, i - 1);
		} else {
			return values;
		}
	}
	function ajax_similarity6( obj, changing_field_id ) {
		jQuery.ajax({
			type: "POST",
			url: fm_objectL10n.form_maker_admin_ajax,
			dataType: "json",
			data: {
				nonce: fm_ajax.ajaxnonce,
				action: 'fm_reload_input',
				page: 'form_maker',
				form_id: 6,
				inputs: obj.inputs
			},
			beforeSend: function() {
				if ( !jQuery.isEmptyObject(obj.inputs) ) {
					jQuery.each( obj.inputs, function( key, val ) {
						wdid = key.split('|')[0];
						if ( val != '' && parseInt(wdid) == parseInt(changing_field_id) ) {
							jQuery("#form6 div[wdid='"+ wdid +"']").append( '<div class="fm-loading"></div>' );
						}
					});
				}
			},
			success: function (res) {
				if ( !jQuery.isEmptyObject(obj.inputs) ) {
					jQuery.each( obj.inputs, function( key, val ) {
						wdid = key.split('|')[0];
						jQuery("#form6 div[wdid='"+ wdid +"'] .fm-loading").remove();
						if ( !jQuery.isEmptyObject(res[wdid]) && ( !val || parseInt(wdid) == parseInt(changing_field_id) ) ) {
							jQuery("#form6 div[wdid='"+ wdid +"']").html( res[wdid].html );
						}
					});
				}
			},
			complete: function() {
			}
		});
	}

    jQuery(document).ready(function () {
		if (jQuery('#form6 .wdform_section').length > 0) {
			fm_document_ready(6);
		}
		else {
			jQuery("#form6").closest(".fm-form-container").removeAttr("style")
		}
		if (jQuery('#form6 .wdform_section').length > 0) {
			formOnload(6);
		}

		var ajaxObj6 = {};
		var value_ids6 = {};

		jQuery.each( jQuery.parseJSON( inputIds6 ), function( key, values ) {
			jQuery.each( values, function( index, input_id ) {
				tagName =  jQuery('#form6 [id^="wdform_'+ input_id +'_elemen"]').prop("tagName");
				type =  jQuery('#form6 [id^="wdform_'+ input_id +'_elemen"]').prop("type");
				if ( tagName == 'INPUT' ) {
					input_value = jQuery('#form6 [id^="wdform_'+ input_id +'_elemen"]').val();
					if ( jQuery('#form6 [id^="wdform_'+ input_id +'_elemen"]').is(':checked') ) { 
						if ( input_value ) {
							value_ids6[key + '|' + input_id] = input_value;
						}
					}
					else if ( type == 'text' ) {
						if ( input_value ) {
							value_ids6[key + '|' + input_id] = input_value;
						}
					}
				}
				else if ( tagName == 'SELECT' ) {
					select_value = jQuery('#form6 [id^="wdform_'+ input_id +'_elemen"] option:selected').val();
					if ( select_value ) {
						value_ids6[key + '|' + input_id] = select_value;
					}
				}
				ajaxObj6.inputs = value_ids6;

				jQuery(document).on('change', '#form6 [id^="wdform_'+ input_id +'_elemen"]', function() {
					var id = '';
					var changing_field_id = '';
					if( jQuery(this).prop("tagName") == 'INPUT' ) {
						if( jQuery(this).is(':checked') ) {
							id = jQuery(this).val();
						}
						if( jQuery(this).attr('type') == 'text' ) {
							id = jQuery(this).val();
						}
					}
					else {
						id = jQuery(this).val();
					}
					value_ids6[key + '|' + input_id] = id;

					jQuery.each( value_ids6, function( k, v ) {
						key_arr = k.split('|');
						if ( input_id == key_arr[2] ) {
							changing_field_id = key_arr[0];
							count = Object.keys(value_ids6).length;
							value_ids6 = unset_fields6( value_ids6, changing_field_id, count );
						}
					});

					ajaxObj6.inputs = value_ids6;
					ajax_similarity6( ajaxObj6, changing_field_id );
				});
			});
		});
		ajax_similarity6( ajaxObj6, null );
    });
    