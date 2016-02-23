<?php
require_once (WEB_ROOT . 'models/extra/AjaxModel.php');
require_once (PHP_ROOT . 'libs/util/HttpRequestHelper.php');
require_once (FINANCE_ROOT . 'common/FinanceAccount.php');
require_once (FINANCE_ROOT . 'common/TransUtility.php');

class RegisterModel extends AjaxModel{
	private $observers = array();
	private $observerData = array();

	protected function GetResponse_() {
		$response = new Response();
		$username = HttpRequestHelper::PostParam('username');
		$password = HttpRequestHelper::PostParam('password');
		$paypassword = HttpRequestHelper::PostParam('paypassword');
		$verificationcode = HttpRequestHelper::PostParam('verificationcode');
		$smsverificationcode = HttpRequestHelper::PostParam('smsverificationcode');
		$address = HttpRequestHelper::PostParam('address');
		$tel = HttpRequestHelper::PostParam('tel');
		$msg = '';
		if(!$this->_DoValidate($username, $password, $paypassword, $tel, $msg)) {
			$response->status = -1;
			$response->msg = $msg;
			return $response;
		}
		if(!$this->_CheckVerifyCode($verificationcode)) {
			$response->status = -1;
			$response->msg = '图形验证码失败';
			return $response;
		}
		if(!$this->_CheckUserNameIsExist($username, $tel)) {
			$response->status = -1;
			$response->msg = '该手机号或用户名已经注册，请直接登录。';
			return $response;
		}
		$error_msg = '';
		if(($ret = $this->_DoRegist($username, $password, $paypassword, $tel, $smsverificationcode, $address, $error_msg)) == false) {
			$response->status = -1;
			$response->msg = $error_msg;
			return $response;
		}
		$this->observerData['source_id'] = 0;
		$this->AddObserver(new \core\CouponQueueObserver());
		$this->_Changed();
		return $response;
	}

	private function _CheckUserNameIsExist($username, $tel) {
		$ret = \core\UserCenterApi::CheckUserNameValid($username, 'STRING');
		if(!isset($ret['status']) || $ret['status'] !== 0) {
			return false;
		}
		$ret = \core\UserCenterApi::CheckUserNameValid($username, 'MOBILE');
		if(!isset($ret['status']) || $ret['status'] !== 0) {
			return false;
		}
		return true;
	}

	private function _CheckVerifyCode($code) {
		$ret = (isset($_SESSION['img_code']) && strtolower($code) === $_SESSION['img_code']);
		unset($_SESSION['img_code']);
		return $ret;
	}

	private function _DoRegist($username, $password, $paypassword, $tel, $smsverificationcode, $address, &$error_msg) {
		$params = array('channel' => 'WEB',	'userName' => $username,'userNameType' => 'STRING',	'password' => $password,'mobile' => $tel,'verifyCode' => $smsverificationcode);
		$ret = \core\UserCenterApi::Regist($params);
		if(!isset($ret['status']) || $ret['status'] !== 0 || !isset($ret['data']['uid'])) {
			$error_msg = $ret['message'];
			return false;
		}
		$paypassword = '';
		$ret2 = \core\FinanceAccountApi::CreateAccount($ret['data']['uid'], $paypassword, 'COMMON_USER');
		if(!isset($ret2['status']) || $ret2['status'] !== 200) {
			$error_msg = 'Fail to create FinanceAccount user';
		}
		$this->observerData['user_id'] = $ret['data']['uid'];
		return true;
	}

	private function _DoValidate(&$username, &$password, &$paypassword, &$tel, &$msg) {
		if(!Utility::ValidateIsUserName($username)) {
			$msg = 'username不合法';
			return false;
		}
		if(!Utility::ValidatePassword($password)) {
			$msg = '密码不合法';
			return false;
		}
		if(!Utility::ValidateIsMobile($tel)) {
			$msg = '电话不合法';
			return false;
		}
		$msg = '';
		return true;
	}

	private function _Changed() {
		foreach($this->observers as $observer) {
			$observer->OnChanged(__CLASS__, $this->observerData);
		}
	}

	public function AddObserver($observer) {
		$this->observers[] = $observer;
	}

}