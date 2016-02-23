<?php
require 'class.phpmailer.php';
require 'class.smtp.php';

/**
 * 发送邮件脚本
 */
Class SendMail {
	
	const SENDMAIL_TO = 'cuiweifeng@wanda.cn,luhongguang@wanda.cn';
	
	public static function mail($to, $subject, $body, $attachment='' ) {

		$mail = new PHPMailer;
		
		$mail->isSMTP();                                     // 设置邮件使用SMTP
		$mail->Host = 'smtp.163.com';  					    // 邮件服务器地址
		$mail->SMTPAuth = true;                              // 启用SMTP身份验证
		$mail->Username = 'g2r_admin';                 		// MTP 用户名  注意：普通邮件认证不需要加 @域名
		$mail->Password = 'G2R_ADMIN!@#$%^';                 // SMTP 密码
		$mail->isHTML(true);                                 // 设置邮件格式为HTML
		$mail->Priority = 3;									// 设置邮件优先级 1：高, 3：正常（默认）, 5：低
		$mail->WordWrap = 70;								// 设置自动换行70个字符
		$mail->CharSet	= "UTF-8";							// 设置邮件字符集 
		$mail->Encoding = "base64";							// 设置邮件编码方式
		$mail->AltBody	="text/html";
		
		$mail->setFrom('g2r_admin@163.com', '监控脚本');		// 发件人邮箱
		$mail->addAddress('cuiweifeng@wanda.cn');
		!$to && $to = self::SENDMAIL_TO;
		$toArr = explode(',', $to);
		foreach ($toArr as $val) {
			$mail->addAddress($val);
		}
// 		$attachment && $mail->addAttachment($attachment);	// 添加附件
		$mail->Subject = $subject;
		$mail->Body    = $body;
		
		if(!$mail->send()) {
			echo date('Y-m-d')."邮件发送有误: " . $mail->ErrorInfo;
		} else {
			echo date('Y-m-d').'邮件发送成功';
		}
	}
	
}

$cmd = "/sbin/ifconfig | grep 'inet addr'|awk '{print $2}'|cut -d ':' -f2 | awk '$1 !~ /127.0.0.1/{print}'| tail -n 1";

$handle = popen($cmd, 'r');
$ip = trim(fread($handle, 1024));
pclose($handle);

$to = 'cuiweifeng@wanda.cn';
$subject = '主题';
$body = 'test mail 邮件发送'.$ip;
SendMail::mail($to, $subject, $body);