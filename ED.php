<?php 
include 'config.php';

session_start();

if(time()-$_SESSION["login_time_stamp"] > (60*60*5)) {
  session_unset();
  session_destroy();
  header("Location:signin.php");
}

if (!isset($_SESSION['name']))
        header("LOCATION: signin.php");
else if ($_SESSION["type"] == 0)
        header("LOCATION: user.php");

  function test_input($var) {
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
  }
  require 'vendor/autoload.php';

	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

if(isset($_GET['id'])){
$_SESSION['id'] = test_input($_GET['id']);
}
$IDP=$_SESSION['id'] ;
if(isset($_SESSION['id'])){
 
  $sql = "select * from product where id ='".$IDP."'";
  $result = mysqli_query($conn, $sql);
  if($row = mysqli_fetch_array($result)){
 
    $prodname = $row["name"];
    $price = $row["price"];
    $desc = $row["description"];
    $img = $row["photo"];
    if (isset($_POST['submit'])) {
      

      $prodname = test_input($_POST["name"]);
      $price = test_input($_POST["price"]);
      $desc = test_input($_POST['description']);
  
      // $img = "imgs/products/" . $_FILES['img']["name"];
      // move_uploaded_file($_FILES['img']["tmp_name"], $img);
      $img_name = $_FILES['img']['name'];
      $img_temp = $_FILES['img']['tmp_name'];

      $img_ex = explode('.', $img_name);
	    $img_ex_acc = strtolower(end($img_ex));

      $allowed_ex = array("jpg", "jpeg", "png"); 

	    if (in_array($img_ex_acc, $allowed_ex)) {
		    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_acc;
		    $img_destination = 'imgs/products/'. $new_img_name;
		    move_uploaded_file($img_temp, $img_destination);



        // AWS Info
	      $bucketName = 'onlinestore-ss-ksu';
	      $IAM_KEY = 'AKIAVJSBIUOZWYPMZY54';
	      $IAM_SECRET = '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';

	      // Connect to AWS
	      // try {
		     // You may need to change the region. It will say in the URL when the bucket is open
		     // and on creation.
		     $s3 = S3Client::factory(
			      array(
				      'credentials' => array(
				  	  'key' => $IAM_KEY,
				  	  'secret' => $IAM_SECRET
              ),
				      'version' => 'latest',
				      'region'  => 'eu-central-1'
			      )
		      );
	      // } catch (Exception $e) {
		    //     // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		    //     // return a json object.
		    //     die("Error: " . $e->getMessage());
	      // }

	
	      // For this, I would generate a unqiue random string for the key name. But you can do whatever.
	      //$keyName = 'imgs/products/' . $new_img_name;
	      //$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
        $pathInS3 ='https://onlinestore-ss-ksu.s3.eu-central-1.amazonaws.com/' . $bucketName . '/' . $img_destination;

	      // Add it to S3
	      try {
		      // Uploaded:
		      $file = $_FILES["fileToUpload"]['tmp_name'];

		      $s3->putObject(
			      array(
				      'Bucket'=>$bucketName,
				      'Key' =>  $img_destination,
				      'SourceFile' => $file,
				      'StorageClass' => 'REDUCED_REDUNDANCY'
			      )
		      );

	      } catch (S3Exception $e) {
		     die('Error:' . $e->getMessage());
	      } catch (Exception $e) {
		      die('Error:' . $e->getMessage());
	      }
      }
      if(isset($img_destination)){
        echo "yes";
      $sql = "UPDATE product SET  name = '$prodname', price = '$price', description ='$desc',photo = '$img_destination' where id = '$IDP'";}
      else {

        $sql = "UPDATE product SET  name = '$prodname', price = '$price', description ='$desc' where id = '$IDP'";
      }
   
      $result = mysqli_query($conn, $sql);
      
       header("Location: manage_product.php");
  }
  }
  
 
}
// else{
//   echo $IDP.'2';
//   echo "bye";
// }



 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signup.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <title>Edit Product</title>
</head>
<body id="edit-product">
    
   <div class="container-css flex-column">
   <a href="index.php" class="my-3 text-bold ">Brand</a>
       <form  class="form" id="form" method="post" action="<?php echo htmlspecialchars("ED.php");?>" enctype="multipart/form-data">
           <div class="header">
               <h2>Edit Product</h2>
           </div>
    <div class="padding">
    <div class="form-control-css ">
     <label for="name">Name</label>
     <input type="text" placeholder="Enter the Name of the product" id="name" name="name" value="<?php echo $prodname; ?>" >
     <i class="fas fa-check-circle"></i>
     <i class="fas fa-exclamation-circle"></i>
     <small>error msg</small>
    </div>


       <div class="form-control-css ">
        <label for="price">Price</label>
        <input type="number" placeholder="Enter your price" id="price" name="price" value="<?php echo $price; ?>">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>error msg</small>
       </div>

       <div class="form-control-css ">
        <label for="img">image</label>
        <br>
        <img src="<?php echo $img; ?>" alt="Pic" width = 200px heigth= 200px style = "margin-left: 50px;"> 
        <input type="file" id="img" name="img" accept="image/*" >
        
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>error msg</small>
       </div>

       <div class="form-control-css ">
        <label for="description">description</label>
        <!-- <input type="text" placeholder="Enter your description" id="description" name="description" value="<?php //echo $desc; ?>"> -->
        <textarea type="text" placeholder="Enter your description" id="description" name="description" ><?php echo $desc;?></textarea>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>error msg</small>
       </div>

  
       <div>
           <button id="submit" name="submit" type="submit" >Save</button>
           
       
       </div>
    </form>
</div>

   </div> 



<div id="modal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
  
        <button  id="close-btn"type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2 class="text-success text-center">Successful</h2>
      </div>
      <div class="modal-footer">
        <button id="close"type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php if($_SERVER['REQUEST_METHOD'] == 'POST'){
           echo"<script>
           document.querySelector('#modal').style.display = 'block';
           document.querySelector('#close').addEventListener('click',()=>{
            document.querySelector('#modal').style.display = 'none';
           });
           document.querySelector('#close-btn').addEventListener('click',()=>{
            document.querySelector('#modal').style.display = 'none';
           });
           </script>";
         } 
         
          
         
         
         ?>
   <script  src="./js/add_product.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>