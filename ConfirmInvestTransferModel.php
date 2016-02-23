<?php
require_once (WEB_ROOT . 'models/extra/AjaxTokenModel.php');
require_once (PHP_ROOT . 'libs/util/HttpRequestHelper.php');
require_once (FINANCE_ROOT . 'common/TransUtility.php');
require_once (FINANCE_ROOT . 'common/FCommon.php');

class ConfirmInvestTransferModel extends AjaxTokenModel{
	protected $need_login = true;
	private $observers = array();
	private $observerData = array();

	protected function GetTokenResponse_() {
		$response = new Response();
		$uid = Cookie::Get(UID);
		$password = HttpRequestHelper::PostParam('password');
		$tcid = HttpRequestHelper::PostParam('tcid');
		$userinfo = json_decode($_SESSION[UINFO], true);
		$loginToken = $userinfo['logintoken'];
		
		if(FCommon::CheckStaff($userinfo['phone']) == false) {
			$response->status = -1;
			$response->msg = FCommon::GetError();
			return $response;
		}
		if($this->_DoValidate($password, $uid) === false) {
			$response->status = -1;
			$response->msg = '参数不合法';
			return $response;
		}
		$transfered_credit = \core\CreditTransferDao::GetCreditTransfer($tcid);
		$userinfo = \core\FinanceAccountApi::GetAccounts($uid);
		if(!isset($userinfo['status']) || $userinfo['status'] !== 200) {
			$response->status = -1;
			$response->msg = '用户异常';
			return $response;
		}
		
		$asset = TransUtility::GetMyAsset($uid);
		if($asset == false || $asset['availablebalance'] < $transfered_credit['money']) {
			$response->status = -2;
			$response->msg = '余额不足';
			$response->data['account_balance'] = $asset == false ? 0 : $asset['availablebalance'];
			return $response;
		}
		
		$check = \core\OneCardApi::CheckPayPwd($uid, md5($password), $loginToken);
		if(!isset($check['status']) || $check['status'] !== 0) {
			$response->status = -1;
			$response->msg = '支付密码不正确';
			return $response;
		}
		
		if(($ret = \core\TradeLogical::InvestTransfer($transfered_credit, $uid)) == false) {
			$error = \core\TradeLogical::GetError();
			$response->status = $error['error_no'];
			$response->msg = $error['error_msg'];
			$response->data = $error;
			return $response;
		}
		
		$this->observerData = array('user_id' => $uid, 'source_id' => 1, 'invest_money' => $transfered_credit['money']);
		$this->AddObserver(new \core\CouponQueueObserver());
		$this->_Changed();
		
		return $response;
	}
	private function _DoValidate($password, $uid) {
		if(empty($password) || empty($uid)) {
			return false;
		}
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