


jQuery(document).ready(function ($) {

    $(document).on('click','.save-yfb',function(event){

        $check = $('#checkbox2').prop("checked");
        $check2 = $('#checkbox3').prop("checked");

             if($check){
                 $check =1;
                }

             if($check  == '' && $check2 == ''){
                 alert("Select A Way!");
               return false;
                }

        var form_data = $("#createTextbox").html();
        var form_title = $("#yform_title").val();


        $("#loadingfmessage").show();

        var action = "yfb_admin_ajax";
        var yfb_admin_nonce = ayfb_url.ayfb_security_nonce;

        $.ajax({

            url: ayfb_url.ayfb_ajax_url,
            type: "POST",
            data:{
                action: action ,
                form_data : form_data,
                form_title:form_title,
                check_admin:$check,
                check2:$check2,
                yfb_admin_nonce: yfb_admin_nonce
                 } ,
            success: function (data) {

                $('#ajax-response-adminf').html(data);
                $('#loadingfmessage').hide();

                }

        });

        e.preventDefault();

    });


	// user ajax functions

    $(document).on('click','.input-f-submit',function(event){
	
		var get_form_id = $(".get_form_id").val();
		var form_name = $(".get_form_id").val();

        var get_form_email = $(".get_form_email").val();
        alert(get_form_email);


		var get_form_captcha = $("#captcha").val();
		var check_form_captcha = $("#captcha-check").val();
       // if(get_form_captcha != check_form_captcha)
       // return false;



		var user_form_data = $("#"+get_form_id).serialize();
        var yfb_user_nonce = uyfb_url.uyfb_security_nonce;

        $("#loadingmessage").show();

        var action = "yfb_user_ajax";

        $.ajax({

            url: uyfb_url.yfb_ajax_url,
            type: "POST",
            data:{
                 user_form_data,
                 'action':action,
                 'yfb_user_nonce':yfb_user_nonce,
				 'form-name':form_name
                 },
            success: function (data) {

                $('#ajax-responseu').html(data);
                $('#loadingmessage').hide();

             }

        });

        e.preventDefault();

    });
	
});