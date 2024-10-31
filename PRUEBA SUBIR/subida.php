<?php
$conn=new PDO('mysql:host=localhost; dbname=senecalib;port=3307', 'root', '') or die(mysql_error());
if(isset($_POST['submit'])!=""){
  $name=$_FILES['file']['name'];
  $size=$_FILES['file']['size'];
  $type=$_FILES['file']['type'];
  $temp=$_FILES['file']['tmp_name'];
  var_dump($_POST);
  var_dump($_FILES);
  // $caption1=$_POST['caption'];
  // $link=$_POST['link'];
  $fname = date("YmdHis").'_'.$name;
  $chk = $conn->query("SELECT * FROM  upload where name = '$name' ")->rowCount();
    if($chk){
        $i = 1;
        $c = 0;
        while($c == 0){
            $i++;
            $reversedParts = explode('.', strrev($name), 2);
            $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
            // var_dump($tname);exit;
            $chk2 = $conn->query("SELECT * FROM  upload where name = '$tname' ")->rowCount();
            if($chk2 == 0){
                $c = 1;
                $name = $tname;
            }
        }
    }
 $move =  move_uploaded_file($temp,"upload/".$fname);
 if($move){
 	$query=$conn->query("insert into upload(name,fname)values('$name','$fname')");
    if($query){
    header("location:index.php");
    }
    else{
    die(mysql_error());
    }
 }
}
?>