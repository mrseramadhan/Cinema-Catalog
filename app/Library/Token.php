<?php 
namespace App\Library;

class Tunnel {

	public function set($data=null,$status=false){
		if(!empty(@$data))
		{
			return array(
				'status'=>$status,
				'message'=>'successful',
				'data'=>$data,
			);
		}
		else
		{
			return array(
				'status'=>$status,
				'message'=>'failed',
				'data'=>$data
			);
		}
	}

}