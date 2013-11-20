$(document).ready(function(e){
	//e.preventDefault();
	$('#commentForm').on('submit', function(e){
		e.preventDefault();
		$('#commentForm').validate({
				debug: false,
				rules: {
					name: "required",
					email: {
						required: true,
						email: true
					}
				},
				messages: {
					name: "Please let us know who you are.",
					email: "A valid email will help us get in touch with you.",
					comments:"Please ask us questions or tell us comments!"
				},
				submitHandler: function(form) {
					// do other stuff for a valid form
					$.post('send_email.php', $("#commentForm").serialize(), function(data) {
						$('#formResults').html(data);
					});
				}
		});
	})
});
