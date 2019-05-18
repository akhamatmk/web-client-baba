<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;

class Homecontroller extends Controller
{
    function index()
    {
    	try {
    		$client = new \GuzzleHttp\Client();
			$response = $client->get(env('URL_API', 'https://api-baba.herokuapp.com').'/file');
	    	$data = json_decode($response->getBody()->getContents(), true);
	    	return view('welcome')->with('data', $data);

	    }catch(\Exception $e) {
            return view('welcome')->with('data', null);
        }

    	
    }

    public function upload()
    {
    	return view('upload');	
    }

    public function file_upload(Request $request)
    {   
    	try { 	
			$client = new \GuzzleHttp\Client();
	    	$image_path = $request->image->getPathname();
			$image_mime = $request->image->getmimeType();
			$image_org  = $request->image->getClientOriginalName();

			$response = $client->post(env('URL_API', 'https://api-baba.herokuapp.com').'/send_file', [
				'multipart' => [
	    			[
	    				'name'     => 'image',
	    				'filename' => $image_org,
	    				'Mime-Type'=> $image_mime,
	    				'contents' => fopen( $image_path, 'r' ),
	    			],
	    			[
	    				'name'     => 'email',
	            		'contents' =>  $request->email,
	    			],
	    			[
	    				'name'     => 'username',
	            		'contents' =>  $request->username,
	    			],
	    		]
	    	]);

	    	$data = json_decode($response->getBody()->getContents(), true);
	    	if($data['error'])
	    	{
	    		Session::flash('message', $data['error_message']);
	    		return redirect('upload');
	    	}
	    	
	    	return redirect('/');
	    }catch(\Exception $e) {
            Session::flash('message', ['any error in server']);
	    	return redirect('upload');
        }
    }
}
