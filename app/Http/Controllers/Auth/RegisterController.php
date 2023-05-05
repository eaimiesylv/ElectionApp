<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Referals;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm(Request $request)
            {
                if ($request->has('user')) {
                 
                   Session::put('refer',$request->query('user'));
                   
                }
                else{
                    Session::put('refer','Admin'); 
                }
                return view('auth.register');
            }
 
    protected function validator(array $data)
    {
      
            return Validator::make($data, [
            'referal' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'max:255'],
           
            'country' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            
            'wallet' => ['required', 'string', 'min:26','max:255'],
           
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $email = Session::get('refer');
        $user=User::where('email',"$email") -> first();
        
       if ($user === null) {
            $refid=1;
        }
       else{
           $refid=$user->id;
       }
        //  $pass=$data['password'];
         // dd($data);
       $user=User::create([
        'referal' => $data['referal'],
        'fname' => $data['fname'],
        'lname' =>$data['lname'] ,
        'email' => $data['email'],
        'gender' =>$data['gender'] ,
       
        'country' =>$data['country'] ,
        'phone' => $data['phone'],
        'zip' => $data['zip'],
        
        'wallet' => $data['wallet'],
       
        'address' =>$data['address'] ,
        'password' =>Hash::make($data['password'])

       ]);

    
       Referals::create([
        'p_id'=>$refid,
        'r_id'=>$user->id,
    ]);
        /*
        Referal::create([
            'p_id'=>$refid,
            'r_id'=>$user->id,
        ]);
        
       
        
        $email=$data['email'];
       
        $username=$data['username'];
        
        $mail = new PHPMailer; 
 
// SMTP configurations 
$mail->isSMTP(); 
$mail->Host        = env('EMAIL_HOST');
$mail->SMTPAuth = true; 
$mail->Username = env('EMAIL_USERNAME'); 
$mail->Password = env('EMAIL_PASSWORD'); 
$mail->SMTPSecure = 'tls'; 
$mail->Port        = 587; 
 
// Sender info  
$mail->setFrom('support@marathondigitalholding.net', 'MarathonDigitalHoldings'); 
 
// Add a recipient  
$mail->addAddress($email);  
 
 
  
// Email subject  
$mail->Subject = 'Account Creation';  
  
// Set email format to HTML  
$mail->isHTML(true);  
  
// Email body content  
$mailContent = ' 
    <div style="width:100%;height:100%;boder-style:solid;background:white">
			<br>
			<div style="width:100%;text-align:center"><img src="https://marathondigitalholding.net/images/logos.jpg" height="80px" width="300px"></div>
			<br>
			<div style="width:100%;text-align:center;font-size:2em;font-weight:bold;color:orange">Account Creation Successful</div>
			<div style="text-align:center;color:black;font-size:1.5em">Your Account Was Created Successfully</div>
			<div style="width:100%;text-align:center;font-size:1.2em;font-weight:bold;color:black">Username:'.$username.'</div>
			<div style="width:100%;text-align:center;font-size:1.2em;font-weight:bold;color:black">Password:'.$pass.'</div><br>

			<div style="width:100%;text-align:center;font-size:1.2em;font-weight:bold;color:black">
						<a href="https://marathondigitalholding.net/login" style="color:orange;background:black;padding:0.3em;text-decoartion:none;list-style-type: square">Login</a>
			</div><br>
			<div style="width:100%;text-align:center;font-size:1.2em;color:black;border-top:1px solid black">
				<i><small>Thank you for choosinging Marathondigitalholdings  Investment. Invite your Friends and get 10% referral Bonus
				when they start investing<small></i>
			
			</div>
		</div>



';  
$mail->Body = $mailContent;  
  
// Send email  
if(!$mail->send()){  
   // dd( 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo);  
}else{  
   // dd('Message has been sent.');  
}
    */
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
        
        
        
        
        
        
        
        
        
        

        return $user;
    }
   
/*
    public function register(Request $request)
    {
            $this->validator($request->all())->validate();
        
            event(new Registered($user = $this->create($request->all())));
        
            \Auth::logout();
        
            return $this->registered($request, $user)
                        ?: redirect("/verify");
 }
 */
}
