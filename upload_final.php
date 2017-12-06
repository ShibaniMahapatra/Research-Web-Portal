<?php
//include('session.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "research_portal";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login_session=1;
if(isset($_FILES['files'])){
    $description=$_POST['des'];
    $res_topic=$_POST['res'];
    $dept=$_POST['dept'];
   // echo $b;
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name1= $_FILES['files']['name'][$key];
        $ext = pathinfo($file_name1, PATHINFO_EXTENSION);
        $file_name=$res_topic.".".$ext;
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	


        $date12 = date('Y-m-d H:i:s');
         if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $query="INSERT into upload_data (USER_CODE,FILE_NAME,FILE_SIZE,FILE_TYPE,description,dept,date1,file_ext,researchtopic) VALUES('$login_session','$file_name','$file_size','$file_type','$description','$dept','$date12','$ext','$res_topic'); ";
         mysqli_query($conn, $query);
        $desired_dir="user_data";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"user_data/".$file_name);
            }else{									//rename the file if another one exist
                $new_dir="user_data/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
           			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		echo "Success";
	}
}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    Research Title:<input type="text" name="res">
    Description:<input type="textbox" name="des">
    Select Department:
    <select name="dept">
        <option>CSE</option>
        <option>EEE</option>
        <option>ECE</option>
        <option>MECH</option>
        <option>CIVIL</option>
    </select>
	Choose file:<input type="file" name="files[]" multiple="" />
	<input type="submit"/>
</form>