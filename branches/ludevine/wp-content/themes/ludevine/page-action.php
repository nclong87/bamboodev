<?php/*Template Name: Action*/$params = getParams();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><title>Ludevine :: Action page</title><script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body><center>Please wait...</center></body></html><script>var params = <?php echo json_encode($params)?>;var baseUrl = '<?php echo DOMAIN ?>';jQuery(document).ready(function(){		jQuery.ajax({		type: 'POST',		cache: false,		data: params,		url: baseUrl + '/ajax',		success: function(response){			response = jQuery.parseJSON(response);			if(response.code == 1) {				location.href = response.data;			} else if(response.code == 0) {				location.href = baseUrl+"?error="+response.data;			}		},		error: function(){			location.href = baseUrl;		}	});});</script>