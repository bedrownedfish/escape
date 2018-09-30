<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	
	public function __construct(){
		
		parent::__construct();

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->library('session');

		$this->load->helper('url');

	}
	public function checkLogin(){

		if(!$this->session->adminId){

			redirect('manage/login','refresh');

		}

	}

	//轮播图列表
	public function slide(){

		$this->checkLogin();

		$data['slide'] = $this->Dbmodel->select()->get('slideshow');

		$this->load->view('manage/slide',$data);
		
	}	
	//获取详细轮播图
	public function setSlide(){

		$this->checkLogin();

		$get = $this->input->get('id');

		if($get){

			$data['codes'] = $this->Dbmodel->select()->where(array('id'=>$get))->get('slideshow',1);

		}
		$this->load->view('manage/setSlide',$data);

	}
	//修改轮播图
	public function slideUpload(){

		$this->checkLogin();

		$config['upload_path'] = 'uploads/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
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

	    	$id = $this->input->get('id');

	    	

	    	if($id){

	    		$code = "uploads/".$img['file_name'];

	    		$a = $this->Dbmodel->ci_update(array('imgs'=>$code,'addtime'=>time()),'slideshow',array('id'=>$id));

	    		if($a){

	    			$mage['message'] = '轮播图更新完成';

	    			$mage['code'] = $code;

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

}

?>