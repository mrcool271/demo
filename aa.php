<?php
// echo number_format(123456.78, 2);

use OSS\OssClient;
use OSS\Core\OssException;

Class Test {
    
    public function run($loan_id){
        $loan_id = 12345;
        $url = 'http://dispatcher.visscaa.com/api/enquiryaspect/report/getfilepath?extractionCode=636874bb78c8c7d2639108d4b9e0520c';
        $sourceDir = '/tmp/shoujia_result/' . $loan_id .'/';
        
        $fileName = $loan_id .'_'. md5(microtime(1) . $this->generateRandomString(10)).'.pdf';
        $this->downloadFromShouJia($sourceDir,$fileName, $url);
        $this->uploadToOSS($sourceDir, $fileName);
        
    
    }
    /**
     * 将首佳估值结果下载到服务器，放到自定义的目录中,
     */
    public function downloadFromShouJia($sourceDir, $fileName, $url)
    {
        
        $fileDir = $sourceDir;
        $this->createFolder($fileDir);
    //     echo file_get_contents($url);
        $localPath = $fileDir . $fileName;
        echo $ret1 = file_put_contents($localPath, file_get_contents($url));
    }
    
    /**
     * 生成随机字符串
     * @param int $length 字符串长度
     * @return string
     */
    public function generateRandomString($length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for ($i = 0; $i < $length; $i ++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $code;
    }
    
    
    /**
     * 新建文件夹
     * @param unknown $path
     */
    public function createFolder($path)
    {
        if (! file_exists($path)) {
            $this->createFolder(dirname($path));
            mkdir($path, 0777);
        }
    }
    
    /**
     * 
     */
    public function uploadToOSS($sourceDir, $fileName){
        $object = $fileName;
        $localPath = $sourceDir . $fileName;
        
        $accessKeyId = OSS_ACCESSKEY_ID ;
        $accessKeySecret = OSS_ACCESSKEY_SECRET;
        $endpoint = OSS_ENDPOINT;
        $bucketName = OSS_BUCKET;
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->uploadFile($bucketName, $object, $localPath);
        } catch (OssException $e) {
        
            testLog("OssException : ");
            testLog($e->getMessage());
        
        }   
    }
    
}

$obj = new Test();
$obj->run(12345);
exit;
