<?php

// echo 1;exit;
set_time_limit(0);
$dataurl = [
    "items" => [
        [
            'key' => 'ttt.jpg',
            'signed_download_url' => "http://test-bjuc.oss-cn-shanghai.aliyuncs.com/example1.jpg"
        ],
        [
            'key' => 'ttt2.jpg',
            'signed_download_url' => "http://test-bjuc.oss-cn-shanghai.aliyuncs.com/example1.jpg"
        ]
    ]
];

$html = '<html><head><meta charset="UTF-8"/></head><body>';
// function
// 新建文件夹
function createFolder($path)
{
    if (! file_exists($path)) {
        createFolder(dirname($path));
        mkdir($path, 0777);
    }
}

// 生成随机字符串
function generate($length)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i ++) {
        $code .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $code;
}

// 文件安全下载函数
function downloads($filename)
{
    if (! file_exists($filename)) {
        header("Content-type: text/html; charset=utf-8");
        echo "无法找到文件";
        exit();
    } else {
        // $file = fopen($name, "r");
        // Header("Content-type: application/octet-stream");
        // Header("Accept-Ranges: bytes");
        // Header("Accept-Length: " . filesize($name));
        // Header("Content-Disposition: attachment; filename=" . $name);
        // echo fread($file, filesize($file_dir . $name));
        // fclose($file);
        // if (! rename($name, $newname)) {
        // echo ("Could not remove!");
        // }
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
        header("Content-Type: application/zip"); // zip格式的
        header("Content-Transfer-Encoding: binary"); // 告诉浏览器，这是二进制文件
        header('Content-Length: ' . filesize($filename)); // 告诉浏览器，文件大小
        @readfile($filename);
    }
}

// 基本数据地址
// $dataurl = $_GET["data"];
// $html .= "==>您的数据文件地址：" . print_r($dataurl, 1) . "</br>";
// echo $dataurl;
// exit;
// 开始解析数据
// if ($dataurl != "") {
    // 准备工作
    $content = $dataurl; // 读取json数据
//     print_r($content);
    $count_ = 10;//count($content['items']); // 统计文件个数
    $html .= "==>一共有" . $count_ . "个文件，开始准备打包，打包过程可能比较长，请您耐心等待。</br>"; // 打印文件个数
                                                                       // exit;
//                                                                        // 新建文件夹
    $foldername = "qiniu";
//     createFolder($foldername);
    // 循环下载文件
//     $i = 10;
    for ($i = 0; $i < $count_; $i ++) {
//         $url = $content['items'][$i]['signed_download_url']; // 文件下载地址
//         $html .= "-->文件" . $url . "打包已完成。</br>";
        file_put_contents($foldername . "/" . 't_'.$i.'.jpg', file_get_contents("http://test-bjuc.oss-cn-shanghai.aliyuncs.com/example1.jpg"));
    }
    // include ("zip.php"); // 引用压缩类 压缩支持：http://www.phpconcept.net/pclzip/
    // $zip = new PclZip($foldername . ".zip"); // 压缩文件
    // $zip->create($foldername);
//     $html .= "==>打包完成，开始准备下载！<b>请在下载完成后关闭本页面,否则会造成文件缺失。</b></br>";
    // 后续删除文件
    // 随机生成替代文件名
//     $path = './';
    // $foldername_new = generate(9);
    // if (! rename($path, $foldername_new)) {
    // $html .= "Could not remove!";
    // }
    
    $filename = "./qiniu.zip";// 最终生成的文件名（含路径）
    if (! file_exists($filename)) {
        // 重新生成文件
        $zip = new ZipArchive(); // 使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
        if ($zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE) {
            exit('无法打开文件，或者文件创建失败');
        }
        // 下载当前目录所在文件夹
        addFileToZip("./qiniu/", $zip);
        $zip->close(); // 关闭
    }
    
    if (! file_exists($filename)) {
        exit("无法找到文件"); // 即使创建，仍有可能失败。。。。
    }
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
    header("Content-Type: application/zip"); // zip格式的
    header("Content-Transfer-Encoding: bytes"); // 告诉浏览器，这是二进制文件
    header('Content-Length: ' . filesize($filename)); // 告诉浏览器，文件大小
    readfile($filename);
    
//     $html .= "==>感谢您使用我们的服务！祝您生活愉快！</br></body></html>";
//     // echo $html;
    // var_dump($filename);
    //downloads($filename);
// } else {
//     $html .= "错误！</body></html>";
//     echo $html;
// }

// 四、将文件夹打包成zip文件
function addFileToZip($path, $zip)
{
    $handler = opendir($path); // 打开当前文件夹由$path指定。
    while (($filename = readdir($handler)) !== false) {
        if ($filename != "." && $filename != "..") { // 文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if (is_dir($path . "/" . $filename)) { // 如果读取的某个对象是文件夹，则递归
                addFileToZip($path . "/" . $filename, $zip);
            } else { // 将文件加入zip对象
                $zip->addFile($path . "/" . $filename);
            }
        }
    }
    @closedir($path);
}