var validationOps = {};

var generateConfiguration = function() {
	window.location = window.location.pathname + 'data/generate';
};

var deleteHost = function(id) {
	window.location = window.location.pathname + 'data/delete/' + id;
};

var editHost = function(id) {
	var d = $('#dialog');
	var u = 'data/form';
	if (id != null) {
		u += '/' + id;
	}
	$.ajax(u).then(function(fData) {
		$('.modal-body', d).html(fData);
		$('form', d).validator(validationOps).on('submit', function (e) {
  			if (e.isDefaultPrevented()) {
    			console.log('invalid');	
  			} else {
    				// everything looks good!
  			}
		});
		d.modal('show');
	});
};


$(document).ready(function(){
	$('#dialog').modal({
		show: false
	});

	$("#modal-save").click(function() {
		var form = $('#dialog form');
		// TODO validate
		form.submit();
	});


	$("#new-host").click(function() {
		editHost(null);
	});

	$("#generate-configuration").click(function() {
		BootstrapDialog.show({
			title : 'Confirmation',
            message: 'Regenerate configuration?',
            buttons: [ {
                icon: 'glyphicon glyphicon-ban-circle',
                label: 'Yes, I am sure',
                cssClass: 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                    generateConfiguration();
                }
            }, {
                label: 'Cancel',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
	});
	$(".edit-host").click(function() {
		var id = $(this).attr('data-id');
		editHost(id);
	});
	$(".delete-host").click(function() {
		var id = $(this).attr('data-id');
		var host = $(this).attr('data-host');

		BootstrapDialog.show({
			title : 'Confirmation',
            message: 'Are you sure you want to delete "' + host + '"?',
            buttons: [ {
                icon: 'glyphicon glyphicon-ban-circle',
                label: 'Yes, I am sure',
                cssClass: 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                    deleteHost(id);
                }
            }, {
                label: 'Cancel',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
	});
});