jQuery(document).ready(function() {
    $('.icheckbox_minimal').css('background','none');
    $('input#chkPrimary').css('opacity', '1');
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");
    $("#btnAddNewVariant").click(function()
			{
				$('#hdnVariantId').val('');
				$('#dlgAddnewVariant').find('input:text,input[type=number], input:password, input:file, select, textarea,input:radio, input:checkbox, #btnVariantSave,.multiselect,.view').removeClass('hide');
				$("#dlgAddnewVariant .btnEdit, #dlgAddnewVariant label.data, #dlgAddnewVariant .alert").addClass('hide');
				$("#dlgAddnewVariant .modal-title").html("Add new variant");
				$("#dlgAddnewVariant").find('input:text,input[type=number], input:password, input:file, select, textarea').val('');
    			$("#dlgAddnewVariant").find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
				$("#dlgAddnewVariant label.data").html('');
				$('#dlgAddnewVariant').modal({'keyboard':true,'show':true,'backdrop':'static'});
			});
    $("#form-variant").validate({
    	rules:{
    		stock:{
    			required:true,
    			number: true,
                digits: true
    		},
            status: { valueNotEquals: "" }
    	},
    	messages:{
    		stock:{
    			required:"Please fill out stock field",
    			number:"Stock must be digits",
    		},
            status: { valueNotEquals: "Please select variant status!" }
    	},
        submitHandler: function() {
            var productId = 0;  
            var productCode = 0;           
            productId = $('#txtId').val() ? $('#txtId').val(): 0;
            productCode = $('#txtCode').val() ? $('#txtCode').val()  : 0;
              
					var param = {'productId':productId,'variantId':$("#hdnVariantId").val(),'productCode':productCode,'sizeName':$('#slcSize option:checked').text(),
							'description': $("#txtVariantDescription").val(),'stock':$("#txtStock").val(),'statusId':$("#slcStatus").val(),'colorName':$('#slcColor option:checked').text(),
							'primary':($("#chkPrimary").is(':checked')?"1":"0"),'size':$("#slcSize").val(),'colorCategoryId':$("#slcColor").val()};
                    var method = $('#hdnVariantId').val()=='' ? 'post' : 'patch';
					var url = $('#hdnVariantId').val()=='' ? '/products/' + productId + '/variants' : '/products/' + productId + '/variants' + '/' + $("#hdnVariantId").val();

                    $.ajax({
                               url: url,
                               type: method,
                               cache: false,
                               contentType: 'application/x-www-form-urlencoded',
                               dataType: 'json',
                               data: $.param(param),
                               success: function(data){
                                   $('#dlgAddnewVariant').modal('hide');
                                   $('#dlgAddnewVariant').removeData();
                                   var tbodyVariant;
						           if(data)
						           {
						           	   if($('#hdnVariantId').val()=='')
						           	   {
								           //showAlert("#dlgAddnewVariant .alert",false,'Success!','Save data success');
								           tbodyVariant = "<tr><td>" + data['id'] + "</td>";
								           tbodyVariant += "<td>" + data['sizeName'] + "</td>";
								           tbodyVariant += "<td>" + data['colorName'] + "</td>";
								           tbodyVariant += "<td>" + data['stock'] + "</td>";
								           tbodyVariant += "<td class='text-center'><input type='button' value='Delete' variantId='" + data['id'] + "' class='btn btn-danger btnDeleteVariant' role='button'>";
										   tbodyVariant += "<input type='button' value='View' variantId='" + data['id'] + "'' class='btn btn-primary btn-mini btnViewVariant' role='button'></td></tr>";
								           //tbodyVariant += $('#new_variant').html();
								           $('#new_variant').append(tbodyVariant);
                                           deleteVariant();
								       }
								       else
								       {
								       		var tr = $('#new_variant input[variantid="' + $('#hdnVariantId').val() + '"]').parent().parent();
								       		tr.find('td').eq(0).html(data['id']);
								       		tr.find('td').eq(1).html(data['sizeName']);
								       		tr.find('td').eq(2).html(data['colorName']);
								       		tr.find('td').eq(3).html(data['stock']);
								       }
							           $('#dlgAddnewVariant').modal('hide');
									   viewVariant();
						           }
						           else
						           {
							           //showAlert("#dlgAddnewVariant .alert",true,'Error!',data['error']);
						           }
					           },
                               error: function(xhr, err) {
						           //showAlert("#dlgAddnewVariant .alert",true,'Error!',formatErrorMessage(xhr, err));
					           }
                           });
				}
    });
    function deleteVariant()
		{
			$("#new_variant tr:last-child .btnDeleteVariant").click(function(e){
				this1 = this;
				if(confirm("You Really want to delete this variant ?"))
				{
					var url = '/products/delete/variants' + "/" + parseInt($(this).attr('variantId'));
                    $.ajax({
                               url: url,
                               type: 'delete',
                               cache: false,
                               dataType: 'json',
                               data: null,
                               success: function(data){
						           if(data)
									{
										//showAlert("#dlgAddnewVariant .alert",false,'Success!','Save data success');
							           	$(this1).closest("tr").remove();
							       	}
							       	else
									{
									   alert('This variant does not exist or does not belong to you ')
										//showAlert("#dlgAddnewVariant .alert",true,'Error!',data['error']);
									}
					           },
                               error: function(xhr, err) {
					               //showAlert("#dlgAddnewVariant .alert",true,'Error!',formatErrorMessage(xhr, err));
					           }
                           });
				}
			});
		};
        
        		function viewVariant()
		{
			$(".btnViewVariant").click(function(e)
			{
				e.preventDefault();
				$("#dlgAddnewVariant .btnEdit , #dlgAddnewVariant label.data").removeClass('hide');
				$('#dlgAddnewVariant').find('input:text,input[type=number], input:password, input:file, select, textarea,input:radio, input:checkbox, #btnVariantSave,.alert,.multiselect,#dlgAddnewVariant .view').addClass('hide');
				$("#dlgAddnewVariant .modal-title").html("Show detail");
                var productId = 0;
				var url = '/products/' + productId + '/variants' + "/" + parseInt($(this).attr('variantId'));
				$.get(url,function(data){
					$("#hdnVariantId").val(data['id']);
					//$("#slcSize").val(data['prices']);
					$("#txtStock").val(data['stock']);
					$("#chkPrimary").val(data['primary']);
					$("#txtVariantStatus").val(data['status_id']);
					$("#txtVariantDescription").val(data['description']);
					$('#slcSize').find('option[value=' + data['size_id'] + ']').attr('selected','selected');
                    $('#slcColor').find('option[value=' + data['color_category_id'] + ']').attr('selected','selected');
					$('#lblSize').text($('#slcSize').find('option[value=' + data['size_id'] + ']').text());
                    $('#lblColorCategory').text($('#slcColor').find('option[value=' + data['color_category_id'] + ']').text());
                    
					$("#lblStock").html(data['stock']);
					$("#lblPrimary").html(data['primary']);
					//$('#lblSize').html($('#slcSize').parent().find('.multiselect').attr('title'));
					$('#dlgAddnewVariant .view').addClass('hide');
					$("#lblVariantStatus").html(data['status_id']);
					$("#lblVariantDescription").html(data['description']);
					$('#dlgAddnewVariant').modal({'keyboard':true,'show':true,'backdrop':'static'});
				}).fail(function(xhr, err) {
					//showAlert("#dlgAddnewVariant .alert",true,'Error!',formatErrorMessage(xhr, err));
				});
			});
		};
        
        $(".btnEdit").click(function()
			{
				$("#dlgAddnewVariant .modal-title").html("Edit");
				$('#dlgAddnewVariant').find('input:text,input[type=number], input:password, input:file, select, textarea,input:radio, input:checkbox,#btnVariantSave,.multiselect,.view').removeClass('hide');
				$("#dlgAddnewVariant .btnEdit , #dlgAddnewVariant label.data,#dlgAddnewVariant .alert,#dlgAddnewVariant input.key").addClass('hide');
				$("#dlgAddnewVariant label.key").removeClass('hide');
			});
    $('#product-dropzone').on('drop', function(event) {
				var image = event.originalEvent.dataTransfer.files[0];
				if(image==undefined)
					return false;
				var arrExtension = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]
				var extension = image.name.substr(image.name.lastIndexOf('.')).toLowerCase();
				if(arrExtension.indexOf(extension)<0)
				{
					alert("#alertImage",true,'Error!','Invalid file Format. Only ' + arrExtension.join(', ') + ' are allowed.');
					return false;
				}

				var formData = new FormData();
				formData.append('image', image);
				formData.append('image_type_id',$('#slcImageType').val());
				if($('#txtId').val()!='')
					formData.append('product_id',$('#txtId').val());
				else
					formData.append('product_id',0);
				if($('#slcImageType').val()=='')
				{
					alert('The image type is required');
				}
				else
				{
					$.ajax('/images/store', {
    					processData: false,
    					contentType: false,
    					type: "POST",
    					data: formData
					}).done(function(data){
						if(!data['error'])
						{
							var html = $("#lstProductImage").html();
							html += '<div class="col-lg-3">';
							html += '<span style="position:relative;"><img  style="max-width:90%; max-height:100px;" src="'+data['uri']+'" />';
							html += '<span class="view iconDeleteImage glyphicon glyphicon-remove" onclick="deleteImage(this,'+data['id']+')"></span></span>';
							html += '<input type="hidden" class="imageId" value="'+ data['id'] +'"></div>';
							$("#lstProductImage").html(html);
							alert('Upload image success');
						}
						else
						{
							alert(data['error']);
						}
					}).fail(function(xhr, err) {
						alert(formatErrorMessage(xhr, err));
					});
				}
		        return false;
			}).on('dragleave', function(event) {
			    $('#product-dropzone').toggleClass("dragging");
		        return false;
			}).on('dragover', function(event) {
		        return false;
			}).on('dragenter', function(event) {
			    $('#product-dropzone').toggleClass("dragging");
		        return false;
			});
});
function deleteImage(el,id)
{
    if(confirm("You Really want to delete this image ?"))
    {
        var url = '/images' + "/" + id;
        $.ajax({
            url: url,
            type: 'delete',
            cache: false,
            dataType: 'json',
            data: null,
            success: function(data){
                if(!data['error'])
				{
				    alert('Delete image success');
      		        $(el).parent().parent().remove();
       	        }
       	        else
				{
				    alert(data['error']);
				}
            },
            error: function(xhr, err) {
                alert(formatErrorMessage(xhr, err));
            }
        });
    }
};