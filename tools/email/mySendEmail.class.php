<?php 
/**
 * 邮件发送类
 * 简介：使用PHPMailer
 * 使用方法：先new 在send
 */
require_once("class.phpmailer.php");
// require 'PHPMailer/PHPMailerAutoload.php';

class MysendEmail extends PHPMailer{

	private $mysmtp; // smtp服务器用户名和密码 $mysmtp['user'] $mysmtp['password']
	private $myfrom; // 发件人邮箱地址和名称 $myfrom['add'] $myfrom['name']
	private $myto; // 收件人邮箱地址和名称 $myto['add'] $myto['name']
	private $mytitle; // 邮件的标题 string
	private $mybody; // 邮件内容 string
	private $myattachment; // 附件路径和名称 $myattachment['path'] $myattachment['name']

	public function __construct($arraySmtp,$arrayFrom, $arrayTo,$title, $body, $arrayAttac=array()) {

		// 执行父类的构造函数
		parent::__construct();

		$this->mysmtp = $arraySmtp;
		$this->myfrom = $arrayFrom;
		$this->myto = $arrayTo;
		$this->mytitle = $title;
		$this->mybody = $body;
		$this->myattachment = $arrayAttac;
	}


	// $this = new PHPMailer(); //实例化


	/**
	 * 返回true是成功 返回false是失败
	 */
	public function mySend() {

		// $this->SMTPDebug = 2;  
		$this->IsSMTP(); // 启用SMTP
		$this->Host = "smtp.qq.com"; //SMTP服务器 以163邮箱为例子
		$this->Port = 25;  //邮件发送端口
		$this->SMTPAuth   = true;  //启用SMTP认证

		$this->CharSet  = "UTF-8"; //字符集
		$this->Encoding = "base64"; //编码方式

		$this->Username = $this->mysmtp['user'];  //你的邮箱 smtp服务器用户名
		$this->Password = $this->mysmtp['password'];  //你的密码 SMTP服务器密码
		$this->Subject = $this->mytitle; //邮件标题

		$this->From = $this->myfrom['add'];  //发件人地址（也就是你的邮箱）
		$this->FromName = $this->myfrom['name'];  //发件人姓名

		$address = $this->myto['add'];//收件人email
		$this->AddAddress($address, $this->myto['name']);//添加收件人（地址，昵称）
		
		$this->IsHTML(true); //支持html格式内容
		// $this->AddEmbeddedImage("logo.png", "my-attach", "logo.png"); //设置邮件中的图片
		// $this->Body = '你好, <b>朋友</b>! <br/>这是一封来自<a href="http://www.helloweba.com" target="_blank">helloweba.com</a>的邮件！<br/><img alt="helloweba" src="cid:my-attach">'; //邮件主体内容
		$this->Body = $this->mybody;  // 暂时不使用图片


		if($this->myattachment){

			$this->AddAttachment($this->myattachment['path'],$this->myattachment['name']); // 添加附件,并指定名称
		}

		//发送
		try {
		
			if(!$this->Send()) {
			  	Log::write('send email fail:' . $this->ErrorInfo);
			  	throw new Exception("邮件发送失败:" . $this->ErrorInfo);
			  	return false;
			} else {
				// $_SESSION['ip'] = get_client_ip();
				// $_SESSION['time'] = time();
				Log::write('send email success!!!');
			  	return true;
			}

		}
		catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
}


 ?>