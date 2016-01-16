$(function() {

	$('#menu a').click(function(e) {
		e.preventDefault();
		loadSection($(this).data('section'), true);
	});

	function loadSection(section, push) {
		$.getJSON('ajax', {
			section: section
		}, function(data) {
			$('title').text(data.title);
			$('#content').html(data.content);
			if (push) {
				history.pushState({
					section: section
				}, data.title, data.url);
			}
		});
	}

	window.onpopstate = function(e) {
		loadSection(e.state.section, false);
	}

});