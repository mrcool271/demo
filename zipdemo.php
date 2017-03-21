<?php
set_time_limit(0);
// debug调试？
define('ZIP_DEBUG', true);
// ZIP文件的根目录
define('ZIP_HOME_PATH',  '/tmp/');//规范说明：所有路径最后都要以'/'结束
//图片host
defined('OSS_IMG_HOST') or define('OSS_IMG_HOST', 'http://test-bjuc.oss-cn-shanghai.aliyuncs.com/');

$data = [
    '身份证' => ['f1' => ['f2' => '20161227140702131.jpg,20161225183125833.jpg,20161225183151730.jpg']],
    '户口本' => ['f1' => ['f2' => '20161225184522653.jpg,20161225184850153.jpg,20161225185056503.jpg']],
    '车辆图' => ['f1' => ['f2' => '20161225190025880.jpg,20161226212927366.jpg']],
    '其他' => ['f1' => '20161227140853487.jpg,20161227141311627.jpg,20161227152335400.jpg'],
    'other' => '20161227140845368.jpg',
];


function run($user_id, $data){
    $userId = 100010;
    $randomString = generateRandomString(10);
    $basePath = ZIP_HOME_PATH . date('Ymd',time()) .'/'. $userId .'/';
    $sourceDir = $basePath . $randomString .'/';
    $outZip = $basePath . $randomString  . '.zip';
    
    downloadImageFromOSS($sourceDir, $data);
    zipDir($sourceDir,$outZip);
    downloadToLocal($outZip);
    
}
run(1, $data);
exit;

/**
 * 将阿里OSS文件下载到服务器，放到自定义的目录中
 */
function downloadImageFromOSS($sourceDir, $data = [])
{
    $folderName = generateRandomString(8);
    $data = MutiArrayToOne($data);
    foreach ($data as $value) {
        // $value = "身份证/f1/f2/a.png,b.png,c.png"
        $bizFolder = dirname(trim($value)) . '/';// 业务自定义文件夹
        $fileDir = $sourceDir . $bizFolder;
        createFolder($fileDir);
        $fileNameArr = explode(',', basename(trim($value)));
        foreach ($fileNameArr as $fileName) {
            file_put_contents($fileDir . $fileName, file_get_contents(OSS_IMG_HOST . $fileName));
        }
    }
//     if (!is_readable($path)) {
//         return false;
//     }
}

// downloadImageFromOSS($data);
// exit;


/**
 * 新建文件夹
 * @param unknown $path
 */
function createFolder($path)
{
    if (! file_exists($path)) {
        createFolder(dirname($path));
        mkdir($path, 0777);
    }
}

// test
// $path = "/tmp/a/b/f/d/e/";
// createFolder($path);
// exit;

/**
 * 生成随机字符串
 * @param int $length 字符串长度
 * @return string
 */
function generateRandomString($length)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i ++) {
        $code .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $code;
}

/**
 * 多维数组转一维数组，
 * @param array $data 
 * @return array 一维数组
 */
function MutiArrayToOne($data, $delimiter = '/')
{
    
    $result = array();
    $tmpStr = '';
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, [$key . $delimiter . current(MutiArrayToOne($value, $delimiter))]);
        } else {
            array_push($result, $key . $delimiter . $value);
            $tmpStr = '';
        }
        $tmpStr = '';
    }
    return $result;
}
// $ret = MutiArrayToOne($data);
// foreach ($ret as $val) {
//     echo dirname($val). '==';
// }
// print_r($ret);
// exit;

/**
 * 获取指定目录下文件列表
 * @param string $dir 完整路径
 * @param bool   $basename 返回路径中基本的文件名部分
 * @return array 一维数组
 */
function listDir($dir, $basename = false)
{
    $result = array();
    if (is_dir($dir)) {
        $file_dir = scandir($dir);
        print_r($file_dir);exit;
        foreach ($file_dir as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } elseif (is_dir($dir . $file)) {
                $result = array_merge($result, list_dir($dir . $file . '/', $basename));
            } else {
                if ($basename) {
                    array_push($result, $file);
                }else {
                    array_push($result, $dir . $file);
                }
            }
        }
    }
    return $result;
}

// test 获取列表
// $datalist = list_dir('/Users/cui/Downloads/', true);
// print_r($datalist);
// exit;

/**
 * Zip一个文件夹 (include itself).
 * Usage:
 *   zipDir('/path/to/sourceDir/', '/path/to/out.zip');
 *
 * @param string $sourceDir 完整目录地址以斜杠结束
 * @param string $outZip 最终生成的zip文件名（含路径）
 */
function zipDir($sourceDir,$outZip)
{
    if (! file_exists($outZip)) {
        // 重新生成文件
        $zip = new ZipArchive(); // 使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
        if ($zip->open($outZip, ZipArchive::CREATE|ZipArchive::OVERWRITE) !== TRUE) {
            exit('无法打开文件，或者文件创建失败');
        }
        // 下载指定目录所在文件夹
        folderToZip($sourceDir, $zip, strlen(dirname($sourceDir))+1);
        $zip->close(); // 关闭
    }
}

/**
 * 将文件夹打包成zip文件
 * @param string $folder 完整目录地址以斜杠结束
 * @param object $zip  ZipArchive对象
 */
function folderToZip($folder, &$zip, $exclusiveLength)
{
    $folder = rtrim($folder,'/');
    $handler = opendir($folder); // 打开当前文件夹由$path指定。
    while (($fileName = readdir($handler)) !== false) {
        if ($fileName != "." && $fileName != "..") { // 文件夹文件名字为'.'和‘..’，不要对他们进行操作
            $filePath = $folder . "/" . $fileName;
            $localPath = substr($filePath, $exclusiveLength);
            if (is_dir($filePath)) { // 如果读取的某个对象是文件夹，则递归
                $zip->addEmptyDir($localPath);
                folderToZip($filePath, $zip, $exclusiveLength);
            } else { // 将文件加入zip对象
                $zip->addFile($filePath, $localPath);
            }
        }
    }
    @closedir($folder);
}

/**
 * 文件下载到本地
 * @param string $fileName  完整文件名（含路径）
 */
function downloadToLocal($fileName)
{
    if (! file_exists($fileName)) {
        header("Content-type: text/html; charset=utf-8");
        echo "无法找到文件";
        exit();
    }
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header('Content-disposition: attachment; filename=' . basename($fileName)); // 文件名
    header("Content-Type: application/zip"); // zip格式的
    header("Content-Transfer-Encoding: binary"); // 告诉浏览器，这是二进制文件
    header('Content-Length: ' . filesize($fileName)); // 告诉浏览器，文件大小
    flush();
    @readfile($fileName);
}