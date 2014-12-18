+function ($) {
	'use strict';

	/* Toggler checkbox handler */
	$(document).on('click', '#user-times input[type="checkbox"]', function(event) {
		var $target = $(event.currentTarget);

		$target.closest('.day').find('input[type="text"]').prop('disabled', !$target.prop('checked'));
	})

} (jQuery)