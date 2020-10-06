<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Library\Tunnel;
use App\Models\Model_Movie;
use Illuminate\Routing\UrlGenerator;

class Movie extends BaseController
{

	protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function create(Request $request)
    {
    	$request->validate([
    		'_token' => 'required',
    		'picture' => 'required',
    		'movie_name' => 'required',
    		'duration' => 'required',
    		'description' => 'required'
    	]);
    	try{
    		$path = 'assets/img';
    		$picture = $request->file('picture');
    		$format_named = 'PIC'.date('ymdhisu').'.'.$picture->getClientOriginalExtension();
            $picture->move($path, $format_named);
            
            $result = Model_Movie::create([
                'picture' => $format_named,
                'movie_name' => $request->movie_name,
                'duration' => $request->duration,
                'description' => $request->description
            ]);
            if(!empty(@$result->id_movie))
            {
            	session(['message' => array('success','Success!','new movie was added')]);
            }
            else
            {
            	session(['message' => array('danger','Failed!','some problem when we add')]);
            }
            return redirect()->back();
        }
        catch (Exception $exception){
            return redirect()->back(); 
        }
    	
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'_token' => 'required',
    		'id' => 'required',
    		'movie_name' => 'required',
    		'duration' => 'required',
    		'description' => 'required'
    	]);
    	try{
    		$path = 'assets/img';
    		$picture = @$request->file('picture');
            if(!empty($picture))
            {
            	$format_named = 'PIC'.date('ymdhisu').'.'.@$picture->getClientOriginalExtension();
            	@$picture->move(@$path, @$format_named);
	            Model_Movie::where('id_movie',@json_decode(pack('H*',@$request->id))->id_movie)->update([
	                'picture' => $format_named
	            ]);
            }
            
            $result = Model_Movie::where('id_movie',@json_decode(pack('H*',@$request->id))->id_movie)->update([
                'movie_name' => $request->movie_name,
                'duration' => $request->duration,
                'description' => $request->description
            ]);
            if($request)
            {
            	session(['message' => array('success','Success!','movie was updated')]);
            }
            else
            {
            	session(['message' => array('danger','Failed!','some problem when we update')]);
            }
            return redirect()->back();
        }
        catch (Exception $exception){
            return redirect()->back(); 
        }
    }

    public function delete(Request $request)
    {
    	$request->validate([
    		'_token' => 'required',
    		'id' => 'required',
    	]);
    	try{
    		
            $result = Model_Movie::where('id_movie',@json_decode(pack('H*',@$request->id))->id_movie)->delete();
            if($result)
            {
            	session(['message' => array('success','Success!','to remove selected movie')]);
            }
            else
            {
            	session(['message' => array('danger','Failed!','some problem when we remove')]);
            }
            return redirect()->back();
        }
        catch (Exception $exception){
            return redirect()->back(); 
        }
    }

    public function list(Request $request)
    {
  		$data = [];
  		$data['list'] = Model_Movie::get();
    	return view('list',$data);
    }

    public function detail(Request $request)
    {
    	$data = [];
    	$data['list'] = Model_Movie::where('id_movie',@json_decode(pack('H*',@$request->id))->id_movie)->get();
    	return view('detail',$data);
    }
}
