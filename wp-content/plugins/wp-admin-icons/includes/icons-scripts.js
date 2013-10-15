jQuery(document).ready(function() {

    //Set Icons w/ Select
    jQuery("#iconDropDown").change(function() {
		
		var setIconDropDownValue = jQuery(this).val();
		
		var iconToReplace = jQuery("#newIconHiddenField").text();

		var iconToReplaceValue = jQuery("#new-"+setIconDropDownValue+"-icon").val();

		if(iconToReplaceValue == '') {
			
			jQuery("#new-"+setIconDropDownValue+"-icon").val(iconToReplace);

		} else {
			var answer = confirm("Are you sure you want to replace the icon already in place?");
				if(answer) {
						jQuery("#new-"+setIconDropDownValue+"-icon").val(iconToReplace)
				}
		}
	});
	
	jQuery(".clearIcon").click(function() {
		jQuery(this).parent().append('<p>Working...</p>');

	});

	jQuery("#uploadShow").click(function() {
		jQuery(".uploadIconTable").slideDown('slow');

	});

    //Icon Paging

   jQuery(".loadMyIcons").click(function() {

                    jQuery(".myIconList").load('/wp-content/plugins/wp-admin-icons/includes/showfiles-upload.php', function(response, status) {
                          if (status == "success") {
                              jQuery(".myWpAdminIconsTable").slideDown('fast');
                              if(jQuery(".myIconList").children().length == 0) {
                                    jQuery(".myIconList").append("You have no uploaded icons.  You can upload a custom icon sprite below.");
                                    jQuery(".myWpAdminIconsTable").slideDown('fast');
                              }
                          } else {
                            alert('There was a problem loading the icons.');
                          }

                        jQuery(".myIconList li").click(function()  {

                                var message = jQuery(this).html();

                                var iconSrc = jQuery(message).attr("src");
                                // if there's no icon already in the changer box then add one

                                if(jQuery(".iconChangerBox, #newIconHiddenField").html('')) {

                                    jQuery(".iconsTable").slideUp("fast");

                                    jQuery(".myIconsTable").slideUp("fast");

                                    jQuery(this).remove('div.noIcon');

                                    jQuery(".iconChangerBox").append("<ul><li>"+message+"</li></ul>");

                                    jQuery("#newIconHiddenField").append("<p>"+iconSrc+"</p>");

                                } //endif

                            jQuery(".clearIcon").click(function() {
                                jQuery(".setIconTable .iconChangerBox ul").remove();
                                jQuery(".iconsTable").slideDown("fast");

                            });

                        });

                    });

			});// end: .loadMyIcons

		jQuery(".loadIcons, .moreIcons").click(function(){

            //replace text if looping through
            if(jQuery('.moreIcons').text() == 'Page 1 »'){
                jQuery('.moreIcons').text('More Icons »');
            }

            var  url = '/wp-content/plugins/wp-admin-icons/includes/showfiles.php';

            //set parameter variable
            var page = jQuery('.moreIcons').attr('page');

			jQuery(".iconList").load(url + "?page=" + page, function(response, status) {

                if (status == "success") {
                    page++;
                    jQuery('.moreIcons').attr('page', page);

					var msg = "Sorry but there was an error: ";

                    //only slide down if not visible
                    if(!jQuery('.wpAdminIconsTable').is(':visible')) {
					    jQuery(".wpAdminIconsTable").slideDown('fast');
                    } else if(jQuery('.iconList').children().length == 0){
                        jQuery('.iconList').prepend('<p class="end-message">There are no more icons... sorry! We will add more in the future.  If you don\'t like any, why not try uploading one below?</p>');


                        jQuery('.moreIcons').attr('page','1');
                        jQuery('.moreIcons').text('Page 1 »');


                    }

				  } else {

					alert('There was a problem loading the icons.');

                  }

            //WHEN A USER CLICKS AN ICON IN THE LIST
            jQuery(".iconList li").click(function()  {

                    jQuery('html, body').animate({
                             scrollTop: jQuery(".setIconTable").offset().top
                         }, 600);

                    var message = jQuery(this).html();

                    var iconSrc = jQuery(message).attr("src");

                    // if there's no icon already in the changer box then add one
                    if(jQuery(".iconChangerBox, #newIconHiddenField").html('')) {

							jQuery(".iconsTable").slideUp("fast");

							jQuery(".myIconsTable").slideUp("fast");

							jQuery(this).remove('div.noIcon');

							jQuery(".iconChangerBox").append("<ul><li>"+message+"</li></ul>");

							jQuery("#newIconHiddenField").append("<p>"+iconSrc+"</p>");

					}

					jQuery(".clearIcon").click(function() {
						jQuery(".setIconTable .iconChangerBox ul").remove();
						jQuery(".iconsTable").slideDown("fast");

					});

				});// end: .loadIcons click

		});

	});


});