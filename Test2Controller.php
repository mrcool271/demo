<?php
namespace App\Http\Controllers;

use OSS\OssClient;
use OSS\Core\OssException;

class Test2Controller extends Controller
{
    
    public function index(){
        $loan_id = 123;
        $url = 'http://dispatcher.visscaa.com/api/enquiryaspect/report/getfilepath?extractionCode=636874bb78c8c7d2639108d4b9e0520c';
        $sourceDir = '/tmp/shoujia_result/' . $loan_id .'/';
        $ossFolder = 'shoujia/';
    
        $fileName = $loan_id .'_'. md5(microtime(1) . $this->generateRandomString(10)).'.pdf';
        //从首佳下载PDF估值结果快照
        $fileSize = $this->downloadFromShouJia($sourceDir,$fileName, $url);
        if(!$fileSize) {
            echo '下载失败，请手动下载后上传 '.$url;
        }
        //上传OSS
        $localPath = $sourceDir . $fileName;
        $object = $ossFolder . $fileName;
        echo $pdfUrl = $this->uploadToOSS($localPath, $object);
    }
    
   
    /**
     * 将首佳估值结果下载到服务器，放到自定义的目录中
     * @param string $sourceDir
     * @param string $fileName
     * @param string $url
     */
    public function downloadFromShouJia($sourceDir, $fileName, $url)
    {
        $this->createFolder($sourceDir);
        $localPath = $sourceDir . $fileName;
        return file_put_contents($localPath, file_get_contents($url));
    }
    
    /**
     * 上传OSS
     * @param string $sourceDir 
     * @param string $fileName 
     * @param string $ossFolder OSS文件夹
     */
    public function uploadToOSS($localPath, $object){
        $accessKeyId = OSS_ACCESSKEY_ID ;
        $accessKeySecret = OSS_ACCESSKEY_SECRET;
        $endpoint = OSS_ENDPOINT;
        $bucketName = OSS_BUCKET;
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ret = $ossClient->uploadFile($bucketName, $object, $localPath);
            return $pdfUrl = $ret['info']['url'];
        } catch (OssException $e) {
            testLog("OssException : ");
            testLog($e->getMessage());
        }
        return '';
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
     * @param string $path
     */
    public function createFolder($path)
    {
        if (! file_exists($path)) {
            $this->createFolder(dirname($path));
            mkdir($path, 0777);
        }
    }
    
}