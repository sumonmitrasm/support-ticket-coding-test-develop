<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Issue;
use Image;
use Illuminate\Support\Facades\Mail;
class PostController extends Controller
{
   public function post(){
    $posts = Post::get()->toArray();
    $title = "All Tickets";
    return view('admin.post.post')->with(compact('posts','title'));
   }

   public function updatePostStatus(Request $request)
{
    if ($request->ajax()) {
        $data = $request->all();
        if ($data['status'] == "Active") {
            $status = 0;  // Closed...
        } else {
            $status = 1;  // Open.....
        }
        Post::where('id', $data['value_id'])->update(['status' => $status]);
        $post = Post::find($data['value_id']);
        // Send email notification if the post is closed (status = 0)......
        if ($status == 0) {
            $users = User::all();
            foreach ($users as $user) {
                $messageData = [
                    'user_name' => $user->name,
                    'ticket_id' => $data['value_id'],
                    'ticket_subject' => $post['subject'],
                    'ticket_status' => 'closed'
                ];
                Mail::send('emails.email_notification_close', $messageData, function($message) use ($user) {
                    $message->to($user->email)->subject('Ticket is Closed');
                });
            }
        }

        return response()->json(['status' => $status, 'value_id' => $data['value_id']]);
    }
}

    public function deletePost($id){
        $posts = Post::select('image')->where('id',$id)->first();
        $posts_image_path = 'admin/admin_images/post/large/';
        if (file_exists($posts_image_path.$posts->image)) {
            unlink($posts_image_path.$posts->image);
        }
        Post::where('id',$id)->delete();
        return redirect()->back();
    }
    
   public function addEditPost(Request $request, $id=null){
    if ($id=="") {
        $title = "Add New Tickets";
        $post = new Post;
        $message = "Tickets added successfully successfully";
    }else{
        $title = "Update Tickets";
        $post = Post::find($id);
        $message = "Update Tickets Details successfully";
    }
    if($request->isMethod('post'))
        {
            $data = $request->all();
           //dd($data);die;
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    if ($post->image && File::exists(public_path('admin/admin_images/post/large/' . $post->image))) {
                        File::delete(public_path('admin/admin_images/post/large/' . $post->image));
                    }
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $medium_image_path = 'admin/admin_images/post/large/' . $imageName;
                    Image::make($image_tmp)->resize(500,500)->save($medium_image_path);
                    $post->image = $imageName;
                }
            }
            $post->subject = $data['subject'];
            $post->description = $data['description'];
            //for Seo.........................................
            $post->meta_title = $data['meta_title'];
            $post->meta_data = $data['meta_data'];
            $post->heading_tag = $data['heading_tag'];
            $post->meta_keywords = $data['meta_keywords'];
            $post->url_structure = $data['url_structure'];
            $post->schema_markup = $data['schema_markup'];
            $post->meta_robot = $data['meta_robot'];
            $post->meta_description = $data['meta_description'];
            if ($id=="") {
                $post->status = 0;
            }
            $post->save();
            session()->flash('success_message', $message);
            return redirect('admin/post');
        }
    return view('admin.post.add_edit_post')->with(['title'=>$title,'post'=>$post]);
   }

   public function seeTicketIssue(){
    $customarissue = Issue::with('getPost')->get();
    $title = "Customer Issues";
    return view('admin.post.issue')->with(['title'=>$title,'customarissue'=>$customarissue]);
   }

}
