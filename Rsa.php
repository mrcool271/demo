<?php
namespace core;
/**
 * Rsa 签名验签加密解密
 */

class Rsa{

	const Finance_Client_Prikey = '-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQDEe8OOKxbcrCnsv9RJVxust2sHGrzIVksMv0Za5TfCcJ8Ugq25
gc6YQQn9hLYX6dRTmXYoEjDs7aGMLso4hQPeXY7Bax0M8FAJUUOAaJhiNTKOCrPP
ZUgxKvombhSk19+PxNvsJ7eLwPzGYsal2edB8zEFAKn3m7voTMgR4lF4nQIDAQAB
AoGAbnRM6N0cSw2Vu/vS8S/A5QVva10Ch3TLV+0nNe3pvKrnIvabhs+MPldBsH0s
iKDwtdZtb/VZ/7dOu6mKEN/l3d1xwCZ7KcTAMxrLnInM8VAkOzEhRXZnoJ0PXfNX
inEuFn9621eRESwGpZjNE73YJ+AAq1eLxGUxItFkoX9XnZkCQQDklTrf+CR3fKo7
HDzz14dEyabPlLQJpNgS6YZcrxNmaxhNJFPc41Zjc8b7lJAUVbgN5CRYNXh6ck/y
DKd6Dd2rAkEA3AzmqzIi8CIZl/1hzDZAOmbLpkP8YiX157BhWFTdf1kz3+/GhnkJ
rc546PZ9euLBeC0EEQmdIJwaRoeIAirq1wJAe7pTHfxhMNQoCMrmK08UhyVnx6DE
OxwhYUtKUUzrAVsi0k7BniToE/kNUgw+WON1Nv+wtJZs2kqZ/3jeBnEO9QJAaxzI
h5q/EP64UJihK0NZHlR9WvCLAMeTnHTp3ZJpwxyLuLzBeSGfyX/QsS2SxOdt326i
JRz15DK4Q46jcNKtPwJAILF2gWIE7MUVVT4H5HqMVA0a3pqEhpS1bd8rVzvJbd6J
6fV+PElauz+gDgFCOLa+FHIwd7C5uiSBXHDdLXlN0Q==
-----END RSA PRIVATE KEY-----';
	
	const Finance_Server_Pubkey = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDrTUN3L3Um/RmbQUyqJ2Wbel0M
jb70pYgh+lh9V7nhgFAA3BUQUkHU4JDQBqYrWR4lBfWqGkwPVp3F48PGSmasWpVX
pEwOg83dOlDz1mtTFMReqoDv+pkKmuUEv8Pds3MyY3qM4RHyHKIiKbgTf6SOisk2
dVLoFyk+XDUUkXsNZwIDAQAB
-----END PUBLIC KEY-----';
	
    /**
     * 密钥文件
     */
    private static $Rsa_Type = array(
        'onepay' => array(
            'client_pri' => self::Finance_Client_Prikey,
            'server_pub' => self::Finance_Server_Pubkey,
            //'client_pri_file' => 'finance_onepay_client_private_key.pem',
            //'client_pub_file' => 'finance_onepay_client_public_key.pem',
            //'server_pub_file' => 'finance_onepay_server_public_key.pem',
        ),
    );
    
    /**
     * rsa 签名
     * @param string $data
     * @param string $type
     */
    public static function sign($data, $type='onepay'){
    	
        $signStr = '';
        if (isset(self::$Rsa_Type[$type]['client_pri'])){
            $priKey = self::$Rsa_Type[$type]['client_pri'];
//          $priKey = file_get_contents(self::$Rsa_Type[$type]['client_pri_file']);
            $rPrikey = openssl_get_privatekey($priKey);
            openssl_sign($data, $sign, $rPrikey);
            openssl_free_key($rPrikey);

            $signStr = base64_encode($sign);
        }

        return $signStr;
    }

    /**
     * rsa 验证签名
     * 
     * @param string $data
     * @param string $signStr
     * @param string $type
     */
    public static function verify($data, $signStr, $type='onepay'){
    	
        $vRet = false;
        if (isset(self::$Rsa_Type[$type]['server_pub'])){
            $pubKey = self::$Rsa_Type[$type]['server_pub'];
            $vPubkey = openssl_get_publickey($pubKey);
            $vRet = (bool)openssl_verify($data, base64_decode($signStr), $vPubkey);
            openssl_free_key($vPubkey);
        }

        return $vRet;
    }
    

    /**
     * 加密.
     *
     * @param string $data
     * @param string $type
     * @param string $enType {'private': 私钥加密；'public': 公钥加密}
     */
    public static function encrypt($data, $type='onepay', $enType='private'){
        if (isset(self::$Rsa_Type[$type])){
            $_key = self::$Rsa_Type[$type];
        } else {
            return '';
        }
        $method = $enType=='private'? 'privateKeyEncrypt': 'publicKeyEncrypt';
        $key = $enType=='private'? $_key['client_pri'] : $_key['server_pub'];
        
        $rsaBit = 1024;
        $maxEncryptBlock = $rsaBit/8 - 11; //明文的最大加密长度

        $length = strlen($data);
        $offset = 0;
        $i = 0;
        $encrypted = $_encrypted = '';
        while($length-$offset > 0){
            if ($length-$offset > $maxEncryptBlock){
                $_encrypted = self::$method($key, substr($data, $offset, $maxEncryptBlock));
            } else {
                $_encrypted = self::$method($key, substr($data, $offset, $length-$offset));
            }

            $encrypted .= $_encrypted;
            $i++;
            $offset = $i * $maxEncryptBlock;
        }
        
        return base64_encode($encrypted);
    }

    /**
     * rsa 解密.
     *
     * @param string $data
     * @param string $type
     * @param string $enType {public: 公钥解密; private: 私钥解密}
     */
    public static function decrypt($data, $type='onepay', $enType='public'){
        if (isset(self::$Rsa_Type[$type])){
            $_key = self::$Rsa_Type[$type];
        } else {
            return '';
        }
        
        $method = $enType=='public'? 'publicKeyDecrypt': 'privateKeyDecrypt';
        $key = $enType=='public'? $_key['server_pub'] : $_key['client_pri'];
        $rsaBit = 1024;
        $maxDecryptBlock = $rsaBit/8;   //密文的最大解密块
        
        $data = base64_decode($data);
        $length = strlen($data);
        $offset = 0;
        $i = 0;
        $decrypted = $_decrypted = '';

        while ($length-$offset > 0){
            echo "<br><br>".($length-$offset)."<br><br>";
            if ($length-$offset > $maxDecryptBlock){
                $_decrypted = self::$method($key, substr($data, $offset, $maxDecryptBlock));
            } else {
                $_decrypted = self::$method($key, substr($data, $offset, $length-$offset));
            }

            $decrypted .= $_decrypted;
            $i++;
            $offset = $i * $maxDecryptBlock;
        }

        return $decrypted;
    }

    /**
     * 私钥（客户端）加密.
     */
    protected static function privateKeyEncrypt($prik, $data){
        $prikey = openssl_pkey_get_private($prik);
        openssl_private_encrypt($data, $encrypted, $prikey);
        openssl_free_key($prikey);

        return $encrypted;
    }

    /**
     * 公钥（服务端）加密.
     */
    protected static function publicKeyEncrypt($pubk, $data){
        $pubkey = openssl_pkey_get_private($pubk);
        openssl_public_encrypt($data, $encrypted, $pubkey);
        openssl_free_key($pubkey);

        return $encrypted;
    }

    /**
     * 公钥（服务端）解密.
     */
    protected static function publicKeyDecrypt($pubk, $data){
        $pubkey = openssl_pkey_get_public($pubk);
        openssl_public_decrypt($data, $decrypted, $pubkey);
        openssl_free_key($pubkey);

        return $decrypted;
    }

    /**
     * 私钥（客户端）解密.
     */
    protected static function privateKeyDecrypt($prik, $data){
        $prikey = openssl_pkey_get_private($prik);
        openssl_public_decrypt($data, $decrypted, $prikey);
        openssl_free_key($prikey);

        return $decrypted;
    }
}


$obj = new Rsa();
echo $obj->sign('12345');
exit;
