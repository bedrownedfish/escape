<?php
class Publics extends CI_Model{

	//获取验证码
	public function securityCode(){

		$this->load->helper('captcha');

		$code = rand(100000, 1000000);

		$this->load->library('session');

		$session['securityCode'] = $code;

		$this->session->set_userdata($session);

		$vals = array(
		    'word'      => $code,
		    'img_path'  => './captcha/',
		    'img_url'   => 'http://'.$_SERVER['SERVER_NAME'].'/captcha/',
		    //'font_path' => '',
		    'img_width' => '150',
		    'img_height'    => '30',
		    'expiration'    => 7200,
		    'word_length'   => 3,
		    //'font_size' => 16,
		    'img_id'    => 'tyCode',
		    // 'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		    // White background and border, black text and red grid
		    /*'colors'    => array(
		        'background' => array(255, 255, 255),
		        'border' => array(255, 255, 255),
		        'text' => array(0, 0, 0),
		        'grid' => array(255, 40, 40)
		    )*/
		);

		$cap = create_captcha($vals);

		return $cap['image'];exit;

	}
	//密码函数
	public function encryptionCode($code){

		return md5(md5(base64_decode(base64_decode($code))));

	}
	//ajax返回
	public function jsonReturned($message,$type=1){

		$data['message'] = $message;

		$data['types'] = $type;

		echo json_encode($data);return false;

	}
	/*	
		@@:   二维数组排序
		*$arrays			数组

		*$sort_key		键名

		*$sort_order		SORT_ASC    升序(默认)	SORT_DESC 		降序

		*$sort_type		SORT_REGULAR - 默认。将每一项按常规顺序排列。SORT_NUMERIC - 将每一项按数字顺序排列。SORT_STRING - 将每一项按字母顺序排列
	*/
	public function arrSort($arrays,$sort_key,$sort_order=SORT_DESC,$sort_type=SORT_NUMERIC ){

        if(is_array($arrays)){

            foreach ($arrays as $array){

                if(is_array($array)){
 
                    $key_arrays[] = $array[$sort_key];

                }else{

                    return false;

                }

            }
 
        }else{
 
            return false;
  
        }

        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);

        return $arrays;

	}
}
?>