<?php
date_default_timezone_set('Asia/Kolkata');
echo date('d-m-Y H:i');


$date = date_default_timezone_set('Asia/Kolkata');

//If you want Day,Date with time AM/PM
echo $today = date("F j, Y, g:i a T");

//Get Only Current Time 00:00 AM / PM 
echo $today = date("g:i a");
?>

<?php
echo"<br>".str_replace("world","Peter","Hello world! Hello world! Hello world! Hello world! ");
?>
<?php
//$str = 'u_name=>2,u_email=>3,gender=>4,languages=>5,country=>6';
$x = array("u_name"=>"Sumit","u_email"=>"alexoscar","gender"=>"Male","languages"=>"hindi,english");
//$x =  (explode(",",$str));

//echo "<br>".explode("=>",$x[0]);
//print_r(array($x[0]));
//print_r ("<br>".array_keys(array($x[0])));

//$s= explode("=>",$x[0]);
//echo"<br>". $s[0]."  ".$s[1];
//echo"<br>".sizeof($x);

//for($i=0;$i<sizeof($x);$i++){
	//$s= explode("=>",$x[$i]);
	//echo"<br>".$s[0]." : ".$s[1];
//}

echo $x["u_name"];

$conn = mysqli_connect("localhost","root","","test");
//echo"<br>hello";
$x = 'u_name--Sumit**u_email--alexoscar**gender--Male**languages--hindi,english';
//$s='"'.$x.'"'; 
$s = mysqli_real_escape_string($conn ,$x);
$s= '"'.$s.'"';
echo "<br>".$s;
//echo"<br>". str_replace("\\","",$s);
//$sql = "INSERT INTO exp (feature) VALUES($s)";
//if (mysqli_query($conn, $sql)) {
  //  echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}

$x = explode('**',$x);

for($i=0;$i<sizeof($x);$i++){
	$s= explode("--",$x[$i]);
	echo"<br>".$s[0]." : ".$s[1];
	}
$sql = "SELECT * FROM exp Where id = 16";
	if ($x = mysqli_query($conn, $sql)) {
	 echo "New record created successfully";
	}
	 else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 }
	 $row = mysqli_fetch_assoc($x);
	 echo "<br>".$row['feature'];
	 $sql = "CREATE TABLE feature
(id integer PRIMARY KEY,
parent_cats varchar(700),
feature_name varchar(100),
UNIQUE (parent_cats, feature_name));";
mysqli_query($conn, $sql);
$sql = "INSERT INTO feature (parent_cats,feature_name) VALUES('Electronics,Mens Cloths, Mobile','color')";
echo"<br>";
if ($x = mysqli_query($conn, $sql)) {
	 echo "New record created successfully";
	}
	 else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 }
	 
	 //Check box
/*var album_text = [];

$("input[name='album_text[]']").each(function() {
    var value = $(this).val();
    if (value) {
        album_text.push(value);
    }
});
if (album_text.length === 0) {
    $('#error_message').html("Error");
}

else {
  //send data
}



jQuery(document).ready(function() {
    $("#check_uncheck").change(function() {
        if ($("#check_uncheck:checked").length) {
            $(".checkboxes input:checkbox").prop("checked", true);
        } else {
            $(".checkboxes input:checkbox").prop("checked", false);
        }
    })
});



ready(function(){
$('input[type="checkbox"]'). click(function(){
if($(this). prop("checked") == true){
alert("Checkbox is checked." );
}
else if($(this). prop("checked") == false){
alert("Checkbox is unchecked." );
}


*/
$x= 01;
$y=12;
if($x>$y)
{echo"false";}else if($y>$x){echo"True";}

echo"<br>". ucfirst("hello world!");

?> 

<html>
</html>