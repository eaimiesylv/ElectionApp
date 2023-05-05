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
		<h1 class="tlt text-white" style="margin: 20px 0;">USER <span class="text-default">REGISTRATION</span></h1>
		<div class="banner-title">
           <span class="decor-equal"></span>
		</div>
		<div  style="margin: 20px 0;">
			<a href="/">HOME</a> / CREATE AN ACCOUNT
		</div>
	</div>
	<div id="particles-js"></div>
</div>
</div>
<script src="js/regvalidation.js"></script>
<link rel="stylesheet" href="css/intlTelInput.css">
<div class="smallcontainer padding">
	<form action="{{route('register')}}" method="post" class="row" id="register">
	@csrf
        <div class="col-12 col-m-12 col-sm-12">
			<div class="title_container">
				  <h4>Create an Account</h4>
				  <span class="decor_default"></span>
			</div>
		</div>
                <div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="Reference ID(Optional)" value="{{ session()->get('refer')?? Admin }}"  name="referal" style="width:100%" style="width:100%" class="round">
			 @error('referal')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
									
        </div>
         <div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="First Name" required value="{{ old('fname') }}" name="fname" style="width:100%" class="round">
			 @error('fname')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
            <div id="fnameErr" class="form_hint"> First name must not be empty!</div>
        </div>
        <div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="Last Name" required  value="{{ old('lname') }}" name="lname" style="width:100%" class="round">
				 @error('lname')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
            <div id="lnameErr" class="form_hint"> Last name must not be empty!</div>
        </div>
                <div class="col-12 col-m-12 col-sm-12">
			<input type="email" placeholder="Email" required  value="{{ old('email') }}" name="email"  style="width:100%" class="round">
			 @error('email')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
            <div id="emailErr" class="form_hint"> Email must not be empty!</div>
            <div id="emailErra" class="form_hint"> Email format not supportted!</div>
            <div id="emailErrb" class="form_hint"> Email already exist!</div>
            <div id="emailErrc" class="form_hint"><i class="fa fa-spinner fa-spin center"></i></div>
        </div>
        <div class="col-12 col-m-12 col-sm-12">
        	<select name="gender" id="gender"  value="{{ old('gender') }}" style="width:100%" class="round">
				<option selected disabled>Select Sex</option>
                <option id="male">Male</option>
                <option id="female">Female</option>
            </select>
			 @error('gender')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        </div>
		<div class="col-12 col-m-12 col-sm-12">
			
			 <?php 
                                                   require_once("country.html")
                                 ?> 
		</div>
		<div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="Phone Number" required  value="{{ old('phone') }}" name="phone"  style="width:100%" class="round">
            <div id="" class="form_hint"> Phone Number !</div>
			 @error('phone')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        </div>
        <div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="Zip Code" required  value="{{ old('zip') }}"  name="zip"  style="width:100%" class="round">
			 @error('zip')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
            <div id="zipErr" class="form_hint"> Zip code must not be empty!</div>
        </div>
		<div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="Wallet" required  value="{{ old('wallet') }}"  name="wallet"  style="width:100%" class="round">
			 @error('wallet')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
            <div id="" class="form_hint"> Wallet must Not be  empty!</div>
        </div>
        <div class="col-12 col-m-12 col-sm-12">
			<input type="text" placeholder="Address" required name="address"  value="{{ old('address') }}"  style="width:100%" class="round">
			 @error('address')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
            <div id="addressErr" class="form_hint"> Address must not be empty!</div>
        </div>
		<div class="col-12 col-m-12 col-sm-12">
        	<input type="password" placeholder="Password" name="password" style="width:100%" id="password"  class="round">
            <div id="passwordErr" class="form_hint"> Make your password stronger with more letters and at least a numbers</div>
			 @error('password')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        </div>
        <div class="col-12 col-m-12 col-sm-12">
        	<input type="password" placeholder="Confirm Password" required name="password_confirmation" style="width:100%" class="round">
        </div>
        <div class="col-12 col-m-12 col-sm-12"><input type="checkbox" name="age" required> I am 18 years of age or older
        </div>
        <div class="col-12 col-m-12 col-sm-12"><input type="checkbox" name="agree" required checked> I agree to BitFury FX | Your Trusted Bitcoin Mining and Investment Company <a href="#" target="_blank">Terms and conditions</a>
        </div>
        <div class="col-12 col-m-12 col-sm-12"><input type="checkbox" name="mail" required> I agree to receive BitFury FX | Your Trusted Bitcoin Mining and Investment Company and third party emails</label>
        </div>
        <div class="col-12 col-m-12 col-sm-12">
        	<input type="submit" value="Submit" class="btn round default" style="border:0"><br><br>
            <a href="/login">Already have an account</a>
        </div>
	</form>
</div>
<script src="js/intlTelInput.js"></script> 
<style>
.intl-tel-input .country-list {
    background-color: #111111 !important;
    border: 1px solid #2d2d2d !important;
}
.intl-tel-input .country-list .divider { border-bottom: 1px solid #2D2D2D !important; }
.intl-tel-input .selected-flag .iti-arrow { border-top: 4px solid #F1F1F1 !important; }
</style>
<script>
////////disable button

</script>
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