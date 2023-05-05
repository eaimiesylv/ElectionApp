<?php 
						  require_once("header.html");
?>

<script src="js/regvalidation.js"></script>
<div class="banner-area center">
<div class="area">
	<div class="bodycontainer">
		<h1 class="tlt text-white" style="margin: 20px 0;">PASSWORD <span class="text-default">RECOVERY</span></h1>
		<div class="banner-title">
           <span class="decor-equal"></span>
		</div>
		<div  style="margin: 20px 0;">
			<a href="/">HOME</a> / FORGOT PASSWORD
		</div>
	</div>
	<div id="particles-js"></div>
</div>
</div>
<div class="smallcontainer padding">

	
	<form action="fpass" method="post">
	<div class="title_container">
		  <h4>Password Recovery</h4>
		  <span class="decor_default"></span>
		  <p>Please enter your email address. We will send you a link to change the password.</p>
	</div>
	<input id="email" type="email" placeholder="Email" name="email" style="width:100%" class="padding round margintb">
	<input type="hidden" name="subStep" value="1" />
	<input type="submit" value="Submit" class="btn padding round default">
	<p class="margintb">Not a member? <a href="/register">Sign up now</a></p><br>
	</form>
</div>
<a href="#" id="back-to-top" class="back-to-top fa fa-arrow-up show-back-to-top"></a>
<script>
/*--window Scroll functions--*/
$(window).on('scroll', function () {
	/*--show and hide scroll to top --*/
	var ScrollTop = $('#back-to-top');
	if ($(window).scrollTop() > 500) {
		ScrollTop.fadeIn(1000);
	} else {
		ScrollTop.fadeOut(1000);
	}
});
</script>

<?php 
						  require_once("footer.html");
	?>