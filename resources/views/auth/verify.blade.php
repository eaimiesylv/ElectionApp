<?php 
						  require_once("header.html");
?>

<div class="banner-area center">
<div class="area">
	<div class="bodycontainer">
		<h1 class="tlt text-white" style="margin: 20px 0;">VERIFY <span class="text-default">EMAIL</span></h1>
		<div class="banner-title">
           <span class="decor-equal"></span>
		</div>
		<div  style="margin: 20px 0;">
			<a href="/">HOME</a> / VERIFY EMAIL
		</div>
	</div>
	<div id="particles-js"></div>
	
</div>
</div>
    <div class="smallcontainer padding">
    


<form action="/verify" id="verify" method="POST">
		@csrf
    	<div class="title_container">
			  <h4>Email Verification Code:</h4>
			  <span class="decor_default"></span>
		</div>
        <div class="alertdanger">An activation code was sent to your email when you registered. input the code below!</div>
		<input type="hidden" name="email" value="laraveltest1989@gmail.com" />
        <input type="hidden" name="hash" value="47d330f8262d3f9aeb39c50fbfc70bf3" />
			<input type="text" placeholder="Verification Code" required name="key" style="width:100%" class="margintb round">
        	<input type="submit" name="activate" value="Verify Now" class="btn round green" style="width: 100%"><br>
           <a href="verify?email=laraveltest1989@gmail.com&hash=47d330f8262d3f9aeb39c50fbfc70bf3&act=0" class="btn round red margintb" style="width: 100%">Resend Email for Verification</a>
           <br><br><br>
	</form>
	 
    
    </div>
<a href="#" id="back-to-top" class="back-to-top fa fa-arrow-up show-back-to-top"></a>
<script>
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