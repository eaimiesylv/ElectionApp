<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use DateTime;
use Session;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => [
            'verify','forgot','verify_confirm'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=\Auth::user()->id;
        $data = [];
        $history=[];
        $query2=" select count(r_id) as ref from referals where p_id=$user_id ";
       
        $result2=DB::select($query2);
      // $c=$result2->ref;
      $c=$result2[0]->ref;

        $query=" select *
        from (select transactions.amount, 
                            transactions.deposit_status,
                            transactions.withdrawal_status,
                            transactions.created_at,
                            transactions.deposited_at,
                            transactions.depositedup_at,
                            transactions.withdraw_at,
                            transactions.withdrawup_at,
                            transactions.id,
                            transactions.bal,
                            plans.percentage,
                            plans.no_days,
                            plans.id as planid,
                            plans.planname,
                            plans.bitcoin_value
                        from transactions
                        left join plans
                        on  plans.id=transactions.plan_id 
                        where transactions.user_id=$user_id and transactions.deposit_status<5
                        
                        union

                        select transactions.amount, 
                            transactions.deposit_status,
                            transactions.withdrawal_status,
                            transactions.created_at,
                            transactions.deposited_at,
                            transactions.depositedup_at,
                            transactions.withdraw_at,
                            transactions.withdrawup_at,
                            transactions.id,
                            transactions.bal,
                            plans.percentage,
                            plans.no_days,
                            plans.planname,
                            plans.id as planid,
                            plans.bitcoin_value
                        from transactions
                        left join plans
                        on  plans.id=transactions.plan_id 
                        where transactions.user_id=$user_id and transactions.deposit_status>4 )  e
                        order by depositedup_at desc,withdrawup_at desc

                        
                        
                    ";
        //dd($query);
        $result=DB::select($query);
        $i=0;
        $tdeposit=0;
        $twithdraw=0;
        $tearning=0;
        $tpending=0;
        $pwithdraw=0;
        $rwithdraw=0;
        $tinvestment=0;
        $accbal=0;
        $bal=0;
    foreach($result  as $key =>$value){
               $i++;
               $witkey="w".$i;  
                $temp=array();
                $temp_his=array();
                $amt=$value->amount;  
                $dstatus=$value->deposit_status; 
                $wstatus= $value->withdrawal_status;  
                $per=$value->percentage; 
                $days=$value->no_days; 
                $datec=$value->deposited_at; 
                $ddate=$value->depositedup_at; ///date confirmed
                $wdate=$value->withdraw_at; 
               $udate=$value->withdrawup_at; 
                $id=$value->id;
                $bal=$value->bal;
                $planname=$value->planname;
                $planid=$value->planid;
                $bitcoin=$value->bitcoin_value;
                
               
               
               
              
                 //1 =pending deposit 2= confirmed deposit 3 requested Withdrawal  4=approved withdraw
                  ///////////////////////////////////////handles date
                 
                  $earn=$amt+(($amt*$per*$days)/100);
                
                 
                 //  else if ($dstatus==1 && $date2 > $date1){
                      // pending array
                   if($dstatus==1){
                        if($planid<4){
                            $tpending=$tpending+$amt;
                            $type="Pending"; 
                            $deptemp=array();
                            $deptemp=array_merge_recursive($deptemp,array($witkey=>array($amt,$ddate,$planname,$per,$type)));
                            $temp_his=array_merge_recursive($temp_his,array("Deposit"=>$deptemp));
                        }
                        else{
                            $tinvestment=$tinvestment+$amt;
                        }
                           
                   } 
                      // confirmed  deposit
                  else if($dstatus==2){
                     
                      $type="Confirmed";     
                      $tearning=$tearning+$earn;
                      $tdeposit=$tdeposit+$amt;
                     /// $accbal=$accbal+$earn;
                      $deptemp=array();
                      $deptemp=array_merge_recursive($deptemp,array($witkey=>array($amt,$ddate,$planname,$per,$type)));
                      $temp_his=array_merge_recursive($temp_his,array("Deposit"=>$deptemp));
                  
                  } 
                    //////pending withdrawal
                  else if($dstatus==3){
                     
                    $type="Pending";          
                    $tearning=$tearning+$earn;
                    $pwithdraw=$pwithdraw+$earn;
                   $tdeposit=$tdeposit+$amt;
                   $deptemp=array();
                   $deptemp=array_merge_recursive($deptemp,array($witkey=>array($earn,$ddate,$planname,$per,$type)));
                    $temp_his=array_merge_recursive($temp_his,array("Withdraw"=>$deptemp));
               
               } 
                      //all withdraw i.e with per count
                  else  if($dstatus==4){
                    
                   
                      $tearning=$tearning+$earn;
                      $tdeposit=$tdeposit+$amt;
                      $twithdraw=$twithdraw+$earn;
                    

                      $withtemp=array();
                      $withtemp=array_merge_recursive($withtemp,array($witkey=>array($earn,$udate)));
                     
                   } 
                   ////////raw withdrawal allready counted
                   else  if($dstatus==5){
                     
                    $type="Confirmed";    
                    $rwithdraw= $rwithdraw+$amt;
                    $deptemp=array();
                   $deptemp=array_merge_recursive($deptemp,array($witkey=>array($amt,$ddate,$planname,$per,$type)));
                    $temp_his=array_merge_recursive($temp_his,array("Withdraw"=>$deptemp));
                    
                
                 } 
                  $data=array_merge_recursive($data,$temp); 
                  $history=array_merge_recursive($history,$temp_his); 
    }
   ///account balaance===total earning-[total withdrawal+pending withdrawal+pending deposit]
  
   if($bal<0){
       $bal=0;
   }
    $data=array_merge_recursive($data,array('tpending'=>$tpending)); 
    $data=array_merge_recursive($data,array('tdeposit'=>$tdeposit));
    $data=array_merge_recursive($data,array('tinvestment'=>$tinvestment)); 
    $data=array_merge_recursive($data,array('twithdraw'=>$rwithdraw)); 
    //$data=array_merge_recursive($data,array('rwithdraw'=>$rwithdraw));  
    $data=array_merge_recursive($data,array('accbal'=>$bal)); 
    $data=array_merge_recursive($data,array('ref'=>$c)); 
 
    $data=array_merge_recursive($data,array('history'=>$history));
    Session::put('history', $history);
    Session::put('bal', $bal);
     
        return view('home')->with('account', $data);
    }
    public function history()
    {
       $data=Session::get('history');
       //dd($data[0]);
        return view('history')->with('account', $data);
    }
    public function newinvestment()
    {
        return view('newinvestment');
    }
    public function setting()
    {
        $id=\Auth::user()->id;
        $detail=User::findorfail($id);
      
        return view('setting')->with('detail',$detail);
    }
    public function testimony()
    {
        return view('testimony');
    }
    public function tradeview()
    {
        return view('tradeview');
    }
    
    public function deposit()
    {
        return view('deposit');
    }
    public function withdraw()
    {
        $bal=Session::get('bal');
       
        return view('withdraw')->with('bal', $bal);
    }
    public function withdrawprocess(Request $request)
    {
      //$bal=Session::get('bal');
        $id=\Auth::user()->id;
        $data=request()->validate([
            'amt' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'bal' => ['required', 'string', 'max:255']
        ]);
            $amt=$data['amt'];
            $bal=$data['bal'];
            $type=$data['type'];
        
        if(($amt-$bal)>0){
                
                    Session::flash('message', 'Insufficent Balance!'); 
                    return redirect('/home');
        }
        $user=Transaction::create([
            'amount' => $amt,
            'deposit_status' =>5,
            'user_id' => $id,
        ]);
        $query="update transactions set bal=bal-$amt where user_id=$id";
        $affected = DB::select($query);
        Session::flash('message', 'Your Withdrawal Is Successful!'); 
        return redirect('/deposit');
       // return view('withdraw')->with('bal', $bal);
    }
    public function changepassword()
    {
        return view('changepassword');
    }
    public function depositfund()
    {
        $id=\Auth::user()->id;
        
        $cards = DB::select("SELECT transactions.amount, 
                                    plans.planname, 
                                    plans.percentage,
                                    plans.image,
                                    transactions.id
                                    FROM transactions
                                    LEFT JOIN plans
                                    ON transactions.plan_id= plans.id 
                                    where transactions.deposit_status=0 and transactions.user_id=$id
                                     order by transactions.created_at desc limit 1"); 
        
        return view('depositfund')->with('detail', $cards);
    }
    public function newinvestmentfund()
    {
        
        return view('newinvestmentfund');
    }
    public function newinvestmentfundpost()
    {
        $id=\Auth::user()->id;
        $data=request()->validate([
            'amt' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'bal' => ['required', 'string', 'max:255']
        ]);
            //dd($data);
            $amt=$data['amt'];
            $bal=$data['bal'];
            $type=$data['type'];
        
        if(($amt-$bal)>0){
                
                    Session::flash('message', 'Insufficent Balance!'); 
                    return redirect('/home');
        }
        $user=Transaction::create([
            'amount' => $amt,
            'deposit_status' =>1,
            'user_id' => $id,
            'plan_id'=>$type
        ]);
        $query="update transactions set bal=bal-$amt where user_id=$id";
        $affected = DB::select($query);
        Session::flash('message', 'Your Subscription Is Successful!'); 
        return redirect('/home');
        
    }
    public function info()
    {
        $id=\Auth::user()->id;
        $detail=User::findorfail($id);
      
        
        return view('info')->with('detail',$detail);
    }
    public function verify()
    {
        
        return view('auth.verify');
    }
    public function verify_confirm()
    {
      
        return view('auth.verify');
    }
    public function forgot()
    {
        
        return view('auth.fpassword');
    }
    public function newinvestmentpost(Request $request)
    {
        $id=$request->input('pack');
        $detail=Plan::find($id);
        if($id<0){
            
            return view('auth.register');
        }
        
        return view('/newinvestmentfund')->with('data',$detail);
    }
    public function depositpost(Request $request)
    {
        $id=\Auth::user()->id;
        
        $ids = $request->input('type');
       
        $data=request()->validate([
            'amount' => ['required', 'string', 'max:255']
        ]);
        
        $user=Transaction::create([
            'amount' => $data['amount'],
            'user_id' => $id,
            'plan_id' => $ids,
        ]);
       // dd($user);
      // return $user;
         return redirect('/depositfund');


        //return view('auth.fpassword');
    }

    public function processdeposit(Request $request)
    {
       
        $data=request()->validate([
            'msg' => ['required', 'string', 'max:255'],
            'file' => 'mimes:jpeg,jpg,png,gif|required|max:3000'
        ]);
        $path=request('file')->store('uploads','public');
        $ids = $request->input('transid');

        $affected = DB::table('transactions')
        ->where('id', "$ids")
        ->update([
            'image' => $path,
            'message' => $data['msg'],
            'deposit_status'=>1
                ]);
                Session::flash('message', 'Transaction Successful!'); 
                return redirect('/deposit');
    }

    public function updateimage(Request $request)
    {
        $id=\Auth::user()->id;
    
        $data=request()->validate([
          
            'file' => 'mimes:jpeg,jpg,png,gif|required|max:3000'
        ]);
        $path=request('file')->store('passport','public');
      

        $affected = DB::table('users')
        ->where('id', "$id")
        ->update([
            'image' => $path
                ]);
                Session::flash('message', 'Passport Successfully Changed'); 
                return redirect('/setting');
    }

    public function updateprofile(User $user, Request $request){
        $id=\Auth::user()->id;
        $data=request()->validate([
          
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
           
            'gender' => ['required', 'string', 'max:255'],
           
            'country' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            
            'wallet' => ['required', 'string', 'min:26','max:255']
           
           
        ]);
        $affected = DB::table('users')
        ->where('id', "$id")
        ->update([
            'fname' => $data['fname'],
            'lname' =>$data['lname'] ,
            
            'gender' =>$data['gender'] ,
           
            'country' =>$data['country'] ,
            'phone' => $data['phone'],
            'zip' => $data['zip'],
            
            'wallet' => $data['wallet'],
           
                ]);
               
        if($affected>0){
            Session::flash('message', 'Profile Update Completed'); 
            return redirect('/setting');
        }
        else{
            Session::flash('message', 'Try Again'); 
            return redirect('/setting');
        }
               
       
    }
    public function changepass(User $user, Request $request){
        $id=\Auth::user()->id;
        $data=request()->validate([
          
            
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
      
       $pass=$data['password'];
       $pass = Hash::make($pass);
      
        $affected = DB::table('users')
        ->where('id', "$id")
        ->update([
            'password' => "$pass",
          
                ]);
        if($affected==1){
            Session::flash('message', 'Password Updated Successfully'); 
            return redirect('/home');
        }
        else{
            Session::flash('message', 'Try Again'); 
            return redirect('/home');
        }
    }

    public function adminindex(User $user){
        $user=User::paginate(15);
        
       
        return view('admin.dash')->with('user', $user);
    }
    public function admdeposit(Request $request)
    {
       // dd('welcome');
        $pendingdeposit = DB::table('users')
       
        ->leftjoin('transactions', 'users.id', '=', 'transactions.user_id')
        ->leftjoin('plans', 'plans.id', '=', 'transactions.plan_id')
        ->select('users.fname','users.lname','users.email','transactions.image','transactions.amount','plans.planname','plans.percentage','plans.no_days','transactions.id as id','transactions.created_at as date','transactions.plan_id')
        ->where('transactions.deposit_status','=','1') 
        ->paginate(20);
       
       
        return view('admin.deposit')->with('user',$pendingdeposit);
    }
    public function admupdatedeposit(Request $request,  User $user)
    { 
        //$bit=Plan::find(1)->bitcoin_value;
        $ids = $request->input('plan_id');
        //dd($ids);
        $val=explode("/",$ids);
        $id=$val[0];
        $per=$val[1];
        $day=$val[2];
        $plan=$val[3];
        $amt=$val[4];
        $date=$val[5];
        $email=$val[6];
      
         //$type="Deposit ";
         //$status="Approved Deposit ";
        // $return=$amt+(($amt*$per*$day)/100);
        // $bitcoin=$return/$bit;
        
        //
    
       // $date= Carbon::now()->toDateTimeString();
               $affected = DB::table('transactions')
               ->where('id', "$id")
               ->update([
                   'depositedup_at' => "$date",
                   'deposit_status' => 2
                       ]);
                       Session::flash('message', 'Update Successful'); 
                       return redirect('/admindeposit');
   
    }

    public function adminfund(Request $request, User $users)
    {
       //dd(User::all());
        // dd('welcome');
       // $pendingdeposit = DB::table('users')
        //return view('admin.deposit')->with('user',$pendingdeposit);
        return view('admin.addupdate');
    }
    public function delete(Request $request){
         $id = $request->input('delete');
         ////delete from user
         $query="delete from  users where id=$id";
         $users= DB::delete($query);
         ////////delete from transactions table
         $query2="delete from  transactions where user_id=$id";
         $users2= DB::delete($query2);

         $query3="delete from  referals where p_id=$id";
         $users3= DB::delete($query3);

         Session::flash('message', 'Deletion Successful'); 
         return redirect('/admin');

    }
    public function adminfundpost(User $user){
       
        $data=request()->validate([
            'amt' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
        $email=$data['email'];
        $amt=$data['amt'];
        $id = User::select('id')->where('email', $email)->first();
       $id=$id->id;
        if($id>0)
            {
                $affected = DB::table('transactions')
                ->where('user_id', "$id")
                ->update([
                    'bal' => "$amt"
                    
                        ]);
                     
                if($affected>0){
                 
                    Session::flash('message', 'Update Successful'); 
                }else{
                    Session::flash('message', 'No Change Was  Made'); 

                }
                return redirect('/admindeposit');     
             } 
             Session::flash('message', 'No User Found With This Email');     
             return redirect('/admindeposit');         
            

    }

    public function admwithdraw(Request $request)
    {
        
        $query1="select users.fname, users.lname,users.email,
                    transactions.amount,
                    transactions.created_at as date,
                    transactions.id as id
            from users left join 
                transactions on users.id=transactions.user_id 
                where transactions.deposit_status =5
                ";
               // dd($query1);
        $query=DB::Select($query1);
            $maxPage=20;
            $pendingwithdraw = new Paginator($query, $maxPage);


            return view('admin.withdraw')->with('user',$pendingwithdraw);
    }
    public function adminwithdrawupdate(Request $request)
    {
       
        //ids+"/"+earning+"/"+plan+"/"+amount+"/"+date+"/"+email;
        $ids = $request->input('plan_id');
        $val=explode("/",$ids);
        
        $id=$val[0];
        $amount=$val[1];
        $date=$val[2];
        $email=$val[3];
        
      
      
         $type="Withdrawal ";
         $status="Approved Withdrawal ";
        
       

         $date= Carbon::now()->toDateTimeString();
                $affected = DB::table('transactions')
                ->where('id', "$id")
                ->update([
                    'withdrawup_at' => "$date",
                    'deposit_status' => 3
                        ]);
                       // return Redirect::to('/pendingwithdraw');
                       session(['success' =>'Withdraw Updated Successfully']); 
                       
         ///////////////////////////////////////////////////////////////////////////////
         /*$d=$this->emailRepo->alls($type,$status,$plan,$amount,$date,$earning,$bitcoin);
         // SMTP configurations 
         $mail = new PHPMailer; 
         $mail->isSMTP(); 
         $mail->Host        = env('EMAIL_HOST');
         $mail->SMTPAuth = true; 
         $mail->Username = env('EMAIL_USERNAME'); 
         $mail->Password = env('EMAIL_PASSWORD'); 
         $mail->SMTPSecure = 'tls'; 
         $mail->Port        = 587; 
         
         // Sender info  
         $mail->setFrom('support@marathondigitalholding.net', 'MarathonDigitalHolding'); 
         
         // Add a recipient  
         $mail->addAddress($email);  
         
         
         
         // Email subject  
         $mail->Subject = 'Withdrawal Confirmation';  
         
         // Set email format to HTML  
         $mail->isHTML(true); 
         $mailContent =$d;
         $mail->Body = $mailContent;  
 
         // Send email  
         //if(!$mail->send()){  
         // dd( 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo);  
        // }else{  
         // dd('Message has been sent.');  
        // }*/
 
 ////////////////////////////////////////////////////////////////////////////////                









 return redirect('/admindeposit');  

                   
    }
                
}
