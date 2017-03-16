<?php

require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . '/vendor/Common.php';


use OSS\OssClient;
use OSS\Core\OssException;

/******* 阿里云图片存储OSS $accessKeyId $accessKeySecret $endpoint $bucket **********/
//从OSS获得的AccessKeyId
defined('OSS_ACCESSKEY_ID') or define('OSS_ACCESSKEY_ID', '96TeB6P51zcaIw0E');
//从OSS获得的AccessKeySecret
defined('OSS_ACCESSKEY_SECRET') or define('OSS_ACCESSKEY_SECRET', 'vzFxyth7dKgMk0ePOX7dSlmNDdt1fh');
//您选定的OSS数据中心访问域名，例如oss-cn-hangzhou.aliyuncs.com 注意!!!
defined('OSS_ENDPOINT') or define('OSS_ENDPOINT', 'oss-cn-shanghai.aliyuncs.com');
//bucket名称
defined('OSS_BUCKET') or define('OSS_BUCKET', 'test-bjuc');

//图片host
defined('OSS_IMG_HOST') or define('OSS_IMG_HOST', 'http://test-bjuc.oss-cn-shanghai.aliyuncs.com/');


$accessKeyId = OSS_ACCESSKEY_ID ;
$accessKeySecret = OSS_ACCESSKEY_SECRET;
$endpoint = OSS_ENDPOINT;
$bucketName = OSS_BUCKET;
try {
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
} catch (OssException $e) {
    print $e->getMessage();
}

$object = "example1.jpg";
$download_file = "download.jpg";


/**
 *  生成一个带签名的可用于浏览器直接打开的url, URL的有效期是3600秒
 */
// $timeout = 5;
// $options = array(
//     OssClient::OSS_PROCESS => "image/resize,m_lfit,h_100,w_100",
// );
// $signedUrl = $ossClient->signUrl($bucketName, $object, $timeout, "GET", $options);
// echo $signedUrl;
// exit;


// // 先把本地的example1.jpg上传到指定$bucket, 命名为$object
// $ret = $ossClient->uploadFile($bucketName, $object, "example1.jpg");
// var_dump($ret);
// exit;

// 图片水印
$options = array(
    OssClient::OSS_FILE_DOWNLOAD => $download_file,
//     OssClient::OSS_PROCESS => "image/watermark,text_SGVsbG8g5Zu-54mH5pyN5YqhIQ", 
//     OssClient::OSS_PROCESS => "image/format,png",
);

// var_dump($ossClient);
// $ret = $ossClient->listBuckets();//列举用户所有的Bucket
// $ret = $ossClient->getObjectAcl($bucketName, $object);//设置object的ACL属性
// $ret = $ossClient->listObjects($bucketName);//获取bucket下的object列表
// $ret = $ossClient->getObject($bucketName, $object);
// $ret = $ossClient->doesObjectExist($bucketName, $object);
// var_dump($ossClient);
// $ret = $ossClient->getObject($bucketName, $object, $options);
// var_dump($ret);
// exit;

/*
function GrabImage($url,$filename) {
    if($url==""):return false;endif;
    ob_start();
    readfile($url);
    $img = ob_get_contents();
    ob_end_clean();
    $size = strlen($img);
    //w 只写——写方式打开文件，同时把该文件内容清空,把文件指针指向文件开始处。
    //如果该文件已经存在，将删除文件已有内容；如果该文件不存在，则建立该文件
    $fp2=@fopen($filename, "w"); //$filename为文件名
    fwrite($fp2,$img);
    fclose($fp2);
    return $filename;
}
GrabImage("http://test-bjuc.oss-cn-shanghai.aliyuncs.com/example1.jpg","aa.jpg");
*/

// echo mkdir("/Users/cui/Desktop/download/a/b/c/d",0777,true);
// exit;


header("Content-Type:text/html;charset=UTF-8");
/**
 * 通过图片的远程url，下载到本地
 * @param: $url为图片远程链接
 * @param: $filename为下载图片后保存的文件名
 */
function downloadImage($filename, $userid, $userdir = array()) {
    if(empty($filename)) return false;
    $url = "http://test-bjuc.oss-cn-shanghai.aliyuncs.com/";
    $url .= $filename;
    ob_start();
    readfile($url);
    $img = ob_get_contents();
    ob_end_clean();
    $size = strlen($img);
    //当前时间 以此做为文件夹目录
    $date=date("Ymd");
    //以当前日期创建目录
    //"../../../attachment/"为存储目录，
    $zipname =  $userdir[0];
    $userdir = implode('/', $userdir);
    $basedir="/Users/cui/Desktop/download/$date/";
    $zipdir = $basedir.
    $dir="/Users/cui/Desktop/download/$date/$userid/$userdir/";
    if(create_folders($dir)){
        $fp2=@fopen($dir.$filename, "a");//$filename为文件名
        fwrite($fp2,$img);
        fclose($fp2);
//         return $dir.$filename;//返回文件路径
        return $zipdir;
    }
    else{
        return false;
    }
}

function create_folders($dir){
    return is_dir($dir) or  mkdir($dir, 0777, true);
}

//开始下载
if(downloadImage('20161231234400877.jpeg',1001,array('a','b','c','d'))){
    echo 1;
}else{
    echo "false";
}
