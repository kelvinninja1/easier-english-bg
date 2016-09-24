$(document).ready(function(){

	// Init the text to speech, see text-to-speech.js
	EEApp.TextToSpeech.init();

	// Build and init the mobile menu, see mobile-menu.js
	EEApp.MobileMenu();


	/**
	 * If google plus profile url is provided,
	 * fetch the profile image and set it as image src.
	 */
	$userGooglePlusUrls = $('[data-google-plus-url]');
	if ($userGooglePlusUrls.length) {
		$userGooglePlusUrls.each(function(index, el){
			var $el = $(el);
			var googlePlusUrl = $el.data('google-plus-url');
			if (googlePlusUrl.length) {
				$.getJSON(
					googlePlusUrl,
					function(data) {
						var imgUrl = data.image.url;
						imgUrl = imgUrl.replace('sz=50', 'sz=200');
						$el.attr('src', imgUrl);
					}
				);
			}
		});
	}


	/**
	 * Dead-simple feedback / social share form,
	 * based on the user input.
	 */
	$feedbackBtnsHolder = $('#feedback-btns-holder');
	$('#positive-feedback').on('click', function(){
		// Show social box
		$feedbackBtnsHolder.addClass('hidden');
		$('#social-box').removeClass('hidden');

		// Then report it:
		ga('send', 'event', {
			eventCategory: 'Feedback',
			eventAction: 'reply',
			eventLabel: 'Yes'
		});
	});
	$('#negative-feedback').on('click', function(){
		// Show feedback box
		$feedbackBtnsHolder.addClass('hidden');
		$('#suggestion-box').removeClass('hidden');

		// Then report it:
		ga('send', 'event', {
			eventCategory: 'Feedback',
			eventAction: 'reply',
			eventLabel: 'No'
		});
	});


	/**
	 * Toggle show/hide email signup form
	 */
	var $emailSignup = $('#email-signup');
	$('#show-email-signup').on('click', function(){
		$emailSignup
			.toggleClass('hidden')
			.find('input[type=email]').focus();

		// When the user opens the form, report it
		if ($emailSignup.is(':visible')) {
			ga('send', 'event', {
				eventCategory: 'Subscription',
				eventAction: 'open email signup form',
				eventLabel: 'PS'
			});
		}
	});


	/**
	 * Show / hide header when user scrolls, see:
	 * https://github.com/WickyNilliams/headroom.js
	 */
	var header = $('#masthead').get(0);
	var headroom = new Headroom(header, {
		'offset': 205,
		'tolerance': 5,
		'classes': {
			'initial': 'animated',
			'pinned': 'swingInX',
			'unpinned': 'swingOutX'
		}
	});
	headroom.init();


	//Exam START:
	function whereAmI() {
		var location = window.location.href.match(/([^/])+/g);
		return location[location.length - 1];
	}
	$("#close_exam").on("click", function(){
		$(".overlay").fadeOut();
		$("#exam_popup").fadeOut();
		//Remove # from url:
		history.pushState("", document.title, window.location.pathname);
	});
	$("#start_exam").on("click", function(){
		parent.location.hash = "startExam";
		$("#exam_popup, .overlay").fadeIn(700);

		//Scroll to top:
		$('html, body').animate({
			scrollTop: 0
		}, 700);
	});
	$("body").prepend("<div class='overlay' style='display: none;'></div>");
	$("#exam_popup").appendTo("body");

	if( whereAmI() == "#startExam" ){
		$("#start_exam").trigger("click");
	}

	//Randomize question options:
	$.fn.randomize = function(childElem) {
		return this.each(function() {
			var $this = $(this);
			var elems = $this.children(childElem);

			elems.sort(function() { return (Math.round(Math.random())-0.5); });

			$this.remove(childElem);

			for(var i=0; i < elems.length; i++)
			$this.append(elems[i]);
		});
	};
	//Randomize answers:
	$("#exam li").randomize("div.option");
	
	//Checkboxes:
	$(".checkbox, .text").on("click", function(){
		$(this).closest("li").find(".option").removeClass("active wrong correct");
		$(this).closest("li").find(".error_message").fadeOut();
		$(this).closest(".option").addClass("active");
	});
	//Check Results:
	$("#check_results").on("click", function(){
		var correct = 0;
		var wrong = 0;
		$("#exam li").each(function(){
			var $answer = $(this).find(".active");
			if( $answer.data("true") == "X" ){
				$(this).data("answer", "correct");
				correct++;

				//Remove error message:
				$(this).find(".error_message").fadeOut();
				$(this).removeClass("try_again");
				$answer.addClass("correct");
			} else {
				$(this).data("answer", "wrong");
				$(this).addClass("try_again");
				wrong++;

				//Show error message:
				var $errorMessage = $(this).find(".error_message");
				if ( $answer.length == 0 ){
					$errorMessage.text($errorMessage.data("no-answer")).fadeIn();
				} else {
					$errorMessage.text($answer.data("error-message")).fadeIn();
					$answer.addClass("wrong");
				}
			}
		});

		var $resultMessage = $("#exam_popup .result");
		//Scroll to the first error:
		if ( wrong > 0 ) {
			//FadeIn calculation fix:
			var diff = 0;
			if ( $resultMessage.is(":visible") ){
				diff = -10;
			} else {
				diff = 45;
			}

			$('html, body').animate({
				scrollTop: $(".try_again:first").offset().top + diff
			}, 700);

			$("#check_results").text("Провери отново!");
		} else {
			$('html, body').animate({
				scrollTop: 0
			}, 700);
		}

		//Show the result:
		var share_url         	=    window.location.href;
		var share_image      	=    "//dummyimage.com/400x400/ACE1AF/FFFFFF?text=EXERCISE";
		var title               =    "Упражнение по английски език | EasierEnglish.BG";
		var description       	=    "Резултат: " + correct + " верни отговора от общо " + questions_count + " въпроса.";
		var FB_url             	=    "//www.facebook.com/sharer.php?s=100&p[title]="+(title)+"&p[summary]="+description+"&p[url]="+encodeURIComponent(share_url)+"&p[images][0]="+(share_image);
		jQuery("#ref_fb").attr('href', FB_url);

		var questions_count = $("#exam li").length;
		if ( correct >= ( parseInt(questions_count)/2 + 1 ) ) {
			$resultMessage.removeClass("bad").addClass("good");
			$("#ref_fb").fadeIn();
		} else {
			$resultMessage.removeClass("good").addClass("bad");
		}
		$resultMessage.html( "Резултат: <strong>" + correct + " верни отговора</strong> от общо " + questions_count + "." ).fadeIn();
	});
	//Exam END

	//Search Validation:
	/*
	$("#searchform").on("submit", function(e){
		if( $("#s").val().length < 3 ){
			e.preventDefault();
		}
	});
	*/

	/*
	### Send Form START
	*/
	// The text to show up within a field when it is incorrect
	emptyerror = "Задължително поле!";
	emailerror = "Въведи валиден e-mail!";
	function sendForm($form, required_params, $sender_email){
		for (i=0;i<required_params.length;i++) {
			var input = $('#'+required_params[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
				input.addClass("error");
				input.val(emptyerror);
				// errornotice.fadeIn(750);
			} else {
				input.removeClass("error");
			}
		}
		// Validate the e-mail.
		if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($sender_email.val())) {
			$sender_email.addClass("error");
			$sender_email.val(emailerror);
		}

		//if any inputs on the page have the class 'error' the form will not submit
		if ($form.find(":input").hasClass("error")) {
			return false;
		} else {
			return true;
		}
	}

	// Clears any fields in the form when the user clicks on them
	$(":input").focus(function(){		
	   if ($(this).hasClass("error") ) {
			$(this).val("");
			$(this).removeClass("error");
	   }
	});
	/*
	### Send Form END
	*/


	/* Contacts Form START */
	$contactsForm = $("#contactsForm");
	var required_contactsForm = ["contact_name", "contact_email", "contact_message"];
	$contactsForm_email = $("#contact_email");
	$contactsForm.submit(function(){
		if ( sendForm($contactsForm, required_contactsForm, $contactsForm_email) ) {
			var jqxhr = $.post( templateUrl + "/EmailSenders/sendMailFormContacts.php", {
				contact_name: $("#contact_name").val(),
				contact_email: $("#contact_email").val(),
				contact_subject: $("#contact_subject").val(),
				contact_message: $("#contact_message").val()
			});

			jqxhr.success(function(){
				$contactsForm.fadeOut(function(){
					$contactsForm.html("<strong class='success'>Получихме съобщението! :)</strong>").fadeIn();
				});
			});

			return false;
		} else {
			return false;
		}
	});
	$("#submit_contactsForm").on("click", function(){
		$contactsForm.submit();
		return false;
	});
	/* Contacts Form END */


	/* Send a free question Form START */
	$askQuestion_form = $("#get-free-consultation-form");
	var required_askQuestion_Form = ["contact_name", "contact_email", "contact_message"];
	$askQuestion_form_email = $("#contact_email");
	$askQuestion_form.submit(function(){
		if ( sendForm($askQuestion_form, required_askQuestion_Form, $askQuestion_form_email) ) {
			var jqxhr = $.post( templateUrl + "/EmailSenders/sendQuestion.php", {
				contact_name: $("#contact_name").val(),
				contact_email: $("#contact_email").val(),
				contact_message: $("#contact_message").val(),
				contact_city: $("#contact_city").val(),
				contact_age: $("#contact_age").val(),
				topic: $("h1").text()
			});

			jqxhr.success(function(){
				$askQuestion_form.fadeOut(function(){
					$("#feedback_form").html("<p><strong class='success'>Получихме въпроса :)</strong> Очаквай отговор от нас.</p>").hide().fadeIn(600);
				});
			});
			jqxhr.error(function(){
				$askQuestion_form.fadeOut(function(){
					$("#feedback_form").append("<p><strong class='fail'>Ооооупс, нещо формата се счупи :(</strong> Опитай да ни изпратиш запитването директно на мейл: <a href='mailto:team@easierenglish.bg'>team@easierenglish.bg</a> :)</p>").hide().fadeIn(600);
				});
			});


			return false;
		} else {
			return false;
		}
	});
	$("#submit_questionForm").on("click", function(){
		$askQuestion_form.submit();
		return false;
	});
	/* Send a free question Form END */


	/* 
	### Apply for Teacher Form START
	*/
	var teacherApply_div = $("#teacherApply_div");
	teacherApply_div.hide();
	$("#fireTeacherApply_form").on("click", function(){
		$(this).fadeOut();
		teacherApply_div.slideDown();
	});
	$teacherApply_form = $("#teacherApply_form");
	var required_teacherApply_form = ["teacher_name", "teacher_email", "teacher_message"];
	$teacherApply_form_email = $("#teacher_email");
	$teacherApply_form.submit(function(){
		if ( sendForm($teacherApply_form, required_teacherApply_form, $teacherApply_form_email) ) {
			var jqxhr = $.post( templateUrl + "/EmailSenders/applyForTeacher.php", {
				teacher_name: $("#teacher_name").val(),
				teacher_linkedin: $("#teacher_linkedin").val(),
				teacher_phone: $("#teacher_phone").val(),
				teacher_email: $("#teacher_email").val(),
				teacher_message: $("#teacher_message").val()
			});

			jqxhr.success(function(){
				$teacherApply_form.fadeOut(function(){
					$teacherApply_form.html("<p><strong class='success'>Заявката е получена!</strong> Съвсем скоро ще се свържем с теб :)</p>").hide().fadeIn(600);
				});
			});

			return false;
		} else {
			return false;
		}
	});
	$("#submit_applyForTeacherForm").on("click", function(){
		$teacherApply_form.submit();
		return false;
	});

	/* 
	### Apply for Teacher Form END
	*/
	teacherApply_div.hide();
	$("#fireTeacherApply_form").on("click", function(){
		$(this).fadeOut();
		teacherApply_div.slideDown();
	});
	$lessonRequest_form = $("#LessonResuestForm");
	$lessonRequest_form.hide();
	$("#fireLessonRequest_form").on("click", function(){
		$lessonRequest_form.slideToggle();
	});
	var required_lessonRequest_form = ["request_contact_name", "request_contact_email", "request_message"];
	$lessonRequest_form_email = $("#request_contact_email");
	$lessonRequest_form.submit(function(){
		if ( sendForm($lessonRequest_form, required_lessonRequest_form, $lessonRequest_form_email) ) {
			var jqxhr = $.post( templateUrl + "/EmailSenders/requestLesson.php", {
				request_contact_name: $("#request_contact_name").val(),
				request_contact_email: $("#request_contact_email").val(),
				request_message: $("#request_message").val()
			});

			jqxhr.success(function(){
				$lessonRequest_form.fadeOut(function(){
					$lessonRequest_form.html("<p><strong class='success'>Молбата е получена!</strong> Когато урокът е готов, ще се свържем с теб :)</p>").hide().fadeIn(600);
				});
			});

			return false;
		} else {
			return false;
		}
	});
	$("#submit_lessonRequestForm").on("click", function(){
		$lessonRequest_form.submit();
		return false;
	});
	/*
	### Send Form START
	*/


	/* Feedback/Questions Form START */
	var $feedback_form = $("#feedback_form");
	$("#fire_feedbackForm").on("click", function(){
		if( $feedback_form.is(":visible") ){
			$feedback_form.slideUp();
		} else {
			$feedback_form.slideDown();
		}
	});


	/*
	### AutoGenerated Lesson Content START:
	*/
	//Catch Exact Match:
	$.expr[':'].textEquals = $.expr.createPseudo(function(arg) {
	    return function( elem ) {
	        return $(elem).text().match("^" + arg + "$");
	    };
	});
	var $post = $("#post_mainContent");
	//If it is a lesson page:
	if ( $post.size() > 0 ) {
		var $postHeadings = $post.find("h2");
		//If there are any headings:
		if ( $postHeadings.size() > 0 ){
			var autoContent_string = "<p class='autoGeneratedContent_heading'>Съдържание на урока:</p><ol id='pageAutoContent' class='pageAutoContent'>";
			$postHeadings.each(function(index, el){
				autoContent_string += "<li>" + $(el).text() + "</li>";
			});
			autoContent_string += "</ol>";
			$post.find("p:first").after(autoContent_string);

			$("#pageAutoContent").on("click", "li", function(){
				var text_value = $.trim( $(this).text() );
				var $current_h2 = $("h2:contains(" + text_value + ")");

				$('html, body').animate({
				    scrollTop: $current_h2.offset().top - $("#masthead").height() - 10
				}, 1000, function(){
					$current_h2.addClass("highlight");
					$current_h2.animate({
						opacity:"0.8",
						"background-color": "red"
					}, 300, function() {
						$current_h2.animate({
							opacity:"1"
						}, 300);
						$current_h2.removeClass("highlight");
					});
				});
			});
		}
	}
	/*
	### AutoGenerated Lesson Content END:
	*/


	//Accordion QnA:
	var allPanels = $('#questions_accordion > dd').hide();
	$('#questions_accordion > dt > a').click(function() {
		var $answer = $(this).parent().next();
		if ( !$answer.is(":visible") ){
			allPanels.slideUp();
			$answer.slideDown();
		} else {
			$answer.slideUp();
		}
	});


    //Opera font fix:
	if (/Opera/.test (navigator.userAgent)) {
		// we are in Opera
		$("body").css("font-family", "Arial, sans-serif");
	}
});