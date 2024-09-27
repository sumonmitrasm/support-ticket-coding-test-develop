<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Issue;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
class IndexsController extends Controller
{
    public function index(){
        $tickets = Post::get();
        $ticketscount = Post::get()->count();
        return view('frontend.dashboard')->with(compact('tickets','ticketscount'));
    }

    public function sendmessage(Request $request,  $id = null){
        if(!Auth::user()){
            return view('frontend.users.login');
        }
        $tickets = Post::find($id);
        // Send Email notification admin mail.........................................
        $email = 'sumonmitra1000686@gmail.com';
        $messageData = [
            'ticket_no' => $tickets['id'],
            'ticket_subject' => $tickets['subject'],
            'customer_name' => Auth::user()->name,
            'customer_mobile' => Auth::user()->mobile,
            'customer_id' => Auth::user()->id
        ];
        Mail::send('emails.email_notification',$messageData,function($message) use($email){
            $message->to($email)->subject('One Customet opend this Ticket');
        });
        
        return view('frontend.message')->with(compact('tickets'));
    }

    public function issueSubmit(Request $request){
        if ($request->isMethod('post')) {
            Session::forget('error_message');
            Session::forget('success_message');
    		$data = $request->all();
    		//echo "<pre>";print_r($data);die;
                $issue = new Issue;
                $issue->post_id = $data['post_id'];
                $issue->name = $data['name'];
                $issue->mobile = $data['mobile'];
                $issue->email = $data['email'];
                $issue->subject = $data['subject'];
                $issue->description = $data['description'];
                $issue->status = 0;
                $issue->save();
                //send confirmation Email
                $email = 'sumonmitra1000686@gmail.com';
                $messageData = [
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'subject' => $data['subject'],
                    'description' => $data['description']
                ];
                Mail::send('emails.issue_submit',$messageData,function($message) use($email){
                    $message->to($email)->subject('Customer Issue Found');
                });
                //Redirect back with successfull message
                $message = "Successfully send message.";
                Session::put('success_message',$message);
                return redirect()->back();
    	}
    }
}
