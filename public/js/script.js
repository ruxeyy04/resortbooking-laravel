/* Profile Category*/
$(document).ready(function () {
	$("#profile").show();
	$("#cpassword").hide();
	$("#purchased").hide();

	$("#cprofile").click(function () {
		$("#ccpassword, #cpurchased").removeClass("active");
		$(this).addClass("active");
		$("#profile").show();
		$("#cpassword").hide();
		$("#purchased").hide();
	});

	$("#ccpassword").click(function () {
		$("#cprofile, #cpurchased").removeClass("active");
		$(this).addClass("active");
		$("#profile").hide();
		$("#cpassword").show();
		$("#purchased").hide();
	});

	$("#cpurchased").click(function () {
		$("#cprofile, #ccpassword").removeClass("active");
		$(this).addClass("active");
		$("#profile").hide();
		$("#cpassword").hide();
		$("#purchased").show();
	});
});

$("#first").change(function () {
	if ($(".first").hasClass("d-none")) {
		$(".first").removeClass("d-none");
	} else {
		$(".first").addClass("d-none");
	}
});
$("#second").change(function () {
	if ($(".second").hasClass("d-none")) {
		$(".second").removeClass("d-none");
	} else {
		$(".second").addClass("d-none");
	}
});
