<?php

    namespace App\Http\Controllers;

    use App\Post;
    use Illuminate\Http\Request;
    use App\Http\Requests;
    use Mail;
    use Session;

    class PagesController extends Controller {

        public function getIndex() {
            $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
            return view('pages.home')->withPosts($posts);
        }

        public function getAbout() {
            $first = 'Kostas';
            $last = 'Christopoulos';
            $fullname = $first . ' ' . $last;
            $email = 'konstadinoschr@gmail.com';

            $data = [
                'email'     => $email,
                'fullname'  => $fullname
            ];

            return view('pages.about')->withData($data);
        }

        public function getContact() {
            return view('pages.contact');
        }

        public function postContact(Request $request) {
            $request->validate([
                'email'     => 'required|email',
                'subject'   => 'min:3',
                'message'   => 'min:10'
            ]);

            $data = [
                'email'         => $request->email,
                'subject'       => $request->subject,
                'body_message'  => $request->message
            ];

            //for managing lot of emails we can use Mail::queue()
            Mail::send('emails.contact', $data, function($message) use($data){
                $message->from($data['email']);
                $message->to('konstadinoschr@windowslive.com');
                $message->subject($data['subject']);
            });

            Session::flash('success', 'Your Email was sent.');

            return redirect()->url('/');
        }
    }
?>
