<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->library('session');

		$this->load->model('Dbmodel');

		$this->load->model('Publics');

		$this->load->helper('url');

	}
	//检查登陆状态
	public function checkLogin(){

		if(!$this->session->adminId){

			redirect('manage/login','refresh');

		}

	}

	public function login(){

		$data['securityCode'] = $this->Publics->securityCode();

		$this->load->view('manage/login',$data);

	}

	public function msLogin(){

		if($_POST){

			$posts = $this->input->post();

			if($posts['code'] !=$this->session->securityCode){$this->Publics->jsonReturned('验证码不正确',0);exit;}

			$a = $this->Dbmodel->ci_find(array('username'=>$posts['users']),'manage');

			if(!$a){$this->Publics->jsonReturned('账号密码不匹配',0);exit;}

			if($a['pasword']!=$this->Publics->encryptionCode($posts['pass'])){$this->Publics->jsonReturned('账号密码不匹配',0);exit;}

			$this->session->set_userdata(array('adminId'=>$a['id']));

			$this->Publics->jsonReturned('登陆成功');exit;

		}

	}

	public function setConfig(){

		$this->checkLogin();

		$posts = $this->input->post();

		if($posts){

			unset($posts['file']);

			$posts['addtime'] = strtotime($posts['addtime']);

			$a = $this->Dbmodel->ci_update($posts,'config',array('id'=>1));

			$data['message'] = $a?"修改完成！":"修改失败！";	

			echo json_encode($data);exit;

		}

		$data['codes'] = $this->Dbmodel->select()->get('config',1);

		$this->load->view('manage/setConfig',$data);

	}

	public function main(){

		$this->load->view('manage/main');

	}

	public function index()
	{

		$this->checkLogin();

		$this->load->view('manage/index');

	}
	public function upload(){

		$this->load->view('upload');

	}
	public function changepwd(){

		$this->checkLogin();

		$data['adName']=$this->Dbmodel->select()->get('manage',1);

		$posts = $this->input->post();

		if($posts){

			if($data['adName']['pasword'] == $this->Publics->encryptionCode($posts['pas'])){
				if($data['adName']['username'] != $posts['username']){

					if($this->Dbmodel->ci_update(array('username'=>$posts['username']),'manage',array('id'=>1))){

						$data['success'] = '登陆名修改成功';

						$this->Publics->setOption('登陆名修改成功!');

					}else{

						$data['error'] = '登陆名修改失败';

					}

				}
				if($posts['newps'] != ""){
					if($data['adName']['pasword'] != $this->Publics->encryptionCode($posts['newps'])){

						if($this->Dbmodel->ci_update(array('pasword'=>$this->Publics->encryptionCode($posts['newps'])),'manage',array('id'=>1))){

							$data['success'] = '密码修改成功';

						}else{

							$data['error'] = "密码修改失败！";

						};

					}else{

						$data['error'] = "与原密码一致";

					}
				}

			}else{

				$data['error'] = "系统密码错误";

			}

			echo json_encode($data);exit;

		}

		$this->load->view('manage/changepwd',$data);

	}


	public function newsAdd(){

		$this->checkLogin();

		$data['code'] = $this->Dbmodel->select()->get('config',1);

		$this->load->view('manage/newsAdd',$data);

	}
	public function layditImg(){

		$data['code'] = 1;

		$data['msg'] = "上传失败！";

		$data['data']['src'] = '';

		$data['data']['title'] = time();

		$config['upload_path'] = 'uploads/news/';
	    // 允许上传哪些类型
	    $config['allowed_types'] = 'gif|png|jpg|jpeg';
	    // 上传后的文件名，用uniqid()保证文件名唯一
	    $config['file_name'] = uniqid();
	    // 加载上传库
	    $this->load->library('upload', $config);
	    // 上传文件，这里的pic是视图中file控件的name属性
	    $result = $this->upload->do_upload('file');

	    if ($result){

	    	$img = $this->upload->data();

	    	$code = "/uploads/news/".$img['file_name'];

	    	$data['code'] = 0;

	    	$data['msg'] = "上传成功！";

	    	$data['data']['src'] = $code;

	    }
	    echo json_encode($data);

	}
	//添加新闻
	public function newsInset(){

		$posts = $this->input->post();

		$code['types'] = 0;

		$code['message'] = "修改出错，系统错误";
		
		if($posts){

			unset($posts['file']);

			$posts['content'] = trim($posts['content']);

			$posts['contents'] = trim($posts['contents']);
			
			$a = $this->Dbmodel->ci_update($posts,'config',array('id'=>1));
			if($a){

				$code['types'] = 1;

				$code['message'] = "修改成功！";

			}else{

				$code['message'] = "修改出错!";

			}

		}

		echo json_encode($code);

	}
}
