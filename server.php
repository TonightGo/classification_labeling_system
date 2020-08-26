<?php 
// $attr = array("拱眉", "眼袋", "大嘴唇", "大鼻子", "黑发", "浓眉", "胖", "双下巴", "银发", "高颧骨", "男", "小眼睛", "椭圆形脸(长脸)", "尖鼻子", "直发", "卷发", "年轻");
$attr = array("折指");
if (!isset($_POST["num"])) $_POST = $_GET;
if (isset($_POST["num"])) {
    echo json_encode(array("status" => 1, "attr" => $attr[($_POST['num'] + 1) % 1], "aa" => "./label/".trim($_POST["partid"])."/".trim($_POST["filename"]).".txt"));
}
// ob_start();
// if (isset($_POST["val"]) && $_POST["filename"] != "") {
	// $filename = trim($_POST["filename"]).".txt";
	// if (file_exists($filename)) $str = readfile($filename);
	// else $str = "";
	// $arr = explode("\\s+", $str);
	// $arr[$_POST["num"]] = $_POST["val"];
	// $str_new = trim(implode("   ", $arr));	
	// file_put_contents($filename, $str_new);
// }
// ob_end_clean();


// if (isset($_POST["val"]) && $_POST["filename"] != "") {
// 	$filename = "./label/".trim($_POST["filename"]).".txt";
// 	if (file_exists($filename)) {
// 		if (filesize($filename) != 0) {
// 			$handle = fopen($filename, "r");
// 			$str = fread($handle, filesize($filename));
// 			fclose($handle);
// 		}
// 		else $str = "";
// 	}
// 	else $str = "";
// 	$myfile = fopen($filename, "w");
// 	$arr = explode("\\s+", $str);
// 	$arr[$_POST["num"]] = $_POST["val"];
// 	$str_new = trim(implode("   ", $arr));	
// 	fwrite($myfile, $str_new);
// 	fclose($myfile);
// }


// // 写入同一个文件，重复标注一张图片时频繁IO
// $filename = "./label/figure".$_POST["partid"].".txt";
// if (isset($_POST["val"]) && $_POST["val"] == 1) {
// 	if (file_exists($filename)) {
// 		if (filesize($filename) != 0) {
// 			$handle = fopen($filename, "r");
// 			$str = fread($handle, filesize($filename));
// 			fclose($handle);
// 		}
// 		else $str = "";
// 	}
// 	else $str = "";
// 	if ($str == "") {
// 		$myfile = fopen($filename, "w");	
// 		fwrite($myfile, trim($_POST["filename"]).", ");
// 		fclose($myfile);
// 	}
// 	else {
// 		$arr = explode(", ", $str);
// 		$arr = array_diff($arr, [""]);
// 		if (!in_array(trim($_POST["filename"]), $arr)) {
// 			$myfile = fopen($filename, "a");
// 			fwrite($myfile, trim($_POST["filename"]).", ");
// 			fclose($myfile);
// 		}
// 	}
// }
// else if (isset($_POST["val"]) && $_POST["val"] == 0) {
// 	if (file_exists($filename)) {
// 		if (filesize($filename) != 0) {
// 			$handle = fopen($filename, "r");
// 			$str = fread($handle, filesize($filename));
// 			fclose($handle);
// 		}
// 		else $str = "";
// 	}
// 	else $str = "";
// 	if ($str != "") {
// 		$arr = explode(", ", $str);
// 		if (in_array(trim($_POST["filename"]), $arr)) {
// 			$arr = array_diff($arr, [trim($_POST["filename"])]);
// 			$arr = array_diff($arr, [""]);
// 			$myfile = fopen($filename, "w");
// 			$str_new = trim(implode(", ", $arr));
// 			fwrite($myfile, $str_new.", ");
// 			fclose($myfile);
// 		}
// 	}
// }


// 每张图片一个文件
$filename = "./label/".trim($_POST["partid"])."/".trim($_POST["filename"]).".txt";
if (!isset($_POST["val"])) $_POST["val"] = -1;
$handle = fopen($filename, "w");
fwrite($handle, trim($_POST["val"]));
fclose($handle);

?>