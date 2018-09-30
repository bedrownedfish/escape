<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Escape extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		header("Content-type: text/html; charset=utf-8"); 

		$this->load->model('Dbmodel');

	}

	public function index()
	{
		$data = $this->Dbmodel->select()->get('config',1);

		$data['show'] = $this->Dbmodel->select()->get('slideshow');

		$this->load->view('index',$data);

	}
	public function upload(){

		$data = $this->Dbmodel->select()->get('config',1);

		$this->load->view('upload',$data);

	}

	public function content(){

		$code = $this->Dbmodel->select()->get('config',1);

		$this->load->view('content',$code);

	}
	public function contents(){

		$code = $this->Dbmodel->select()->get('config',1);

		$this->load->view('contents',$code);

	}

	public function uploads(){

		$config['upload_path'] = 'uploads/video/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'AVI|WMV|RM|RMVB|MPEG1|MP4|3GP|ASF|SWF|VOB|DAT|MOV|M4V|FLV|F4V|MKV|MTS|TS|avi|wmv|rm|rmvb|mpeg1|mp4|3gp|asf|swf|vob|dat|mov|m4v|flv|f4v|mkv|mts|ts';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();	            
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');
	    // 如果上传成功，获取上传文件的信息
	    $mage = [];

	    $mage['type'] = 0;
	    
	    if ($result){

	    	$img = $this->upload->data();

	    	$id = 1;

	    	if($id){

	    		$code = "uploads/video/".$img['file_name'];

	    		$a = $this->Dbmodel->ci_insert(array('vname'=>$code,'addtime'=>time()),'video');

	    		if($a){

	    			$mage['message'] = '视频上传完成';

	    			$mage['code'] = $code;

	    			$mage['ids'] = $a;

	    			$mage['type'] = 1;

	    		}else{

	    			$mage['message'] = '上传出错';

	    		}

	    	}else{

	    		$mage['message'] = '系统故障，请联系维护人员';

	    	}	        

	    }else{

	    	$mage['message'] = '文件错误';

	    }

	    echo json_encode($mage);exit;

	}
	public function escapes(){

		$post = $this->input->post();
		
		if($post['id']){

			$data = $this->Dbmodel->select()->where(array('id'=>$post['id']))->get('video',1);

			$code['types'] = 1;
			$code['code'] = base_url($data['vname']);
			$code['codename'] = array_slice(explode('/', $data['vname']),-1,1)[0];
			$code['message'] = '转码成功！';
			echo json_encode($code);

		}		

	}
}
