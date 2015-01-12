+function ($) {
	'use strict';

	/* Toggler checkbox handler */
	$(document).on('click', '#user-times input[type="checkbox"]', function(event) {
		var $target = $(event.currentTarget);

		$target.closest('.day').find('input[type="text"]').prop('disabled', !$target.prop('checked'));
	}).on('ready', function(event) {
		$('#user-times input[type="checkbox"]').each(function() {
			$(this).closest('.day').find('input[type="text"]').prop('disabled', !$(this).prop('checked'))
		})
	});

	$("#users_table").on('selection-change', function(event) {
		$('#delete_users input[name="id[]"]').remove();
		$("#users_table tbody").find('input[type="checkbox"]:checked').each(function() {
			$("#delete_users").append('<input type="hidden" name="id[]" value="' + $(this).closest('tr').data('id') + '">');
		});
	})

} (jQuery)