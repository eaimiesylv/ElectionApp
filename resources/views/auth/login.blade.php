<?php 
						  require_once("header.html");
?>
@if ($errors->any())    
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
<div class="banner-area center">
<div class="area">
	<div class="bodycontainer">
		<h1 class="tlt text-white" style="margin: 20px 0;">USER <span class="text-default">LOGIN</span></h1>
		<div class="banner-title">
           <span class="decor-equal"></span>
		</div>
		<div  style="margin: 20px 0;">
			<a href="/">HOME</a> / LOGIN
		</div>
	</div>
	<div id="particles-js"></div>
	
</div>
</div>
    <div class="smallcontainer padding">
	<form action="{{ route('login') }}" method="post">
		@csrf
    	<div class="title_container">
			  <h4>Login Authentication</h4>
			  <span class="decor_default"></span>
		</div>
        			<input type="text" placeholder="Email" required name="email" value="" style="width:100%" class="margintb round">
					 @error('email')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror

        	<input type="password" placeholder="Password" required name="password" style="width:100%" class="margintb round">
				 @error('password')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
			<div class="row margintb">
				<a href="/fpass" class="right">Forgot password?</a>
				<input type="checkbox" name="remember" value="1" id="label"><label for="check"> Remember Me</label>
			</div>
        	<input type="submit" value="Login" class="btn round default"><br><br>
           <br><br>
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