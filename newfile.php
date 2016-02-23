<?php
require_once (PHP_ROOT . 'libs/mvc/Response.php');
require_once (WEB_ROOT . 'models/extra/MyPageModel.php');
require_once (FINANCE_ROOT . 'common/UCenter_RPC.php');

class MyPersonalInfoModel extends MyPageModel{
	protected $need_login = true;
	protected $title = '个人信息';
	protected $js_module = 'finance/pages/my/mypersonalinfo';
	protected $cur_nav = 'my';
	protected $my_nav = 'personal-info';

	/**
	 * Input(GET): {
	 * }
	 *
	 * Output:
	 * 登陆后($response->data) {
	 * <PersonalInfo> info, // 个人详情
	 * }
	 */
	protected function GetResponse_() {
		$response = new Response();
		$uid = Cookie::Get(UID);
		//$uid = '14062619203501093';
		
		$info = $this->_GetUserInfo($uid, $response);
		
		$response->data = array_merge(array(
				'info' => $info 
		), $response->data);
		
		/*
		 * // TEMP $this->_GetFakeResponse($response);
		 */
		
		return $response;
	}

	private function _GetUserInfo($uid, &$response) {
		// $info = UCenter_RPC::getUserInfo(UCenter_RPC::UCENTER_APPID_FINANCE, UCenter_RPC::UCENTER_CHANNEL_WEB, $uid, UCenter_RPC::UCENTER_KEYTYPE_MEMBER_ID);
		$info = \core\UserCenterApi::GetUserInfo($uid, 'MERMBER_ID');
		if(!isset($info['status']) || $info['status'] !== 0) {
			return false;
		}
		
		$data = $info['data'];
		
		return array(
				'tel_verified_status' => $data['mobileCheckStatus'] == 1 ? 'done' : 'notyet',
				'tel' => $data['mobile'],
				
				'name' => $data['username'],
				
				'certificate_verified_status' => 'notyet',
				'certificate' => $data['idcardNo'],
				
				'bank_card_verified_status' => 'notyet',
				'bank_name' => '空',
				'bank_card_no' => $data['cardNo'],
				
				'email_verified_status' => 'notyet',
				'email' => $data['email'],
				
				'facing_risk_test_status' => 'notyet',
				'facing_risk_type_name' => '空' 
		);
	}

	private function _GetFakeResponse(&$response) {
		require_once (WEB_ROOT . 'models/_common_struct.php');
		$response->data = array_merge(array(
				'info' => FakeData::GetPersonalInfo() 
		), $response->data);
		return $response;
	}

}