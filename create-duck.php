
<?php
// check for post
if (isset($_POST['submit'])) {

    $errors = array(
        "name" => "",
        "favorite_foods" => "",
        "biography" => "",
        "img_src" => "",
        );
    
        $name = htmlspecialchars($_POST['name']); 
        $favorite_foods = htmlspecialchars($_POST['favorite_foods']); 
        $biography = htmlspecialchars($_POST['biography']);
        $img_src = $_FILES("img_src"["name"]);
    
        if(empty($name)) {
            // if the name is empty
        
            $errors['name'] = "A name is required.";
    
        } else {
            //if the name is not empty
    
            if(!preg_match('/^[a-z\s]+$/i', $name)) { 
                // "echo there is a name";
        
            $errors["name"] = "This name has illegal characters.";}
        }
    
        if(empty($favorite_foods)) {
    
            $errors['datalist'] = "No fav foods? weirdo";
    
        } else {
    
        if(!preg_match('/^[a-z,\s]+$/i', $favorite_foods)) {
    
        
            $errors["datalist"] = "The name must have a comma between items";}
            
        }
    
    // check if bio is empty
    if(empty($bio)) {
        
        $errors["bio"] = "A bio is required";
    }
    
    // Handle file upload target directory
    $target_dir = "./assets/images/";
    
    // Target uploaded image file
    $image_file = $target_dir . basename($_FILES["img_src"]["name"]);
    
    // Get uploaded file extenstion so we can test to make sure it's an image
    $image_file_type = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));
    
    // Test image for errors

        //image exists
        if(empty($img_src)) {
            $errors["img_src"] = "An image is required.";
        }
    
            // Check that the image file is an actual image
            $size_check = @getimagesize($_FILES["img_src"]["tmp_name"]);
            $file_size = $_FILES["img_src"]["size"];

            // file size
            if(!$size_check) {
                $errors[img_src] = "File is not an image.";
            
    
            // Check if size is smaller than 500k
            } else if ($file_size > 5000000) {
                    $errors["img_src"] = "Filesize limit exceeded.";

            // Check if file type is acceptable
            } else if($image_file_type != "jpg"
                && $image_file_type != "png"
                && $image_file_type != "jpeg"
                && $image_file_type != "gif"
                && $image_file_type != "webp" ) {
                $errors["img_src"] = "Sorry, only JPG, JPEG, PNG, GIF or WEBP files are allowed.";

            } else if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $image_file)) {

            // File uploaded successfully
            } else {
                $errors["img_src"] = "Sorry, there wan an error uploading your file.";
            }
        
    
    if(!array_filter($errors)) {
        // everything is good, form is valid
    
        // connect ot the database
        require('./config/db.php');
    
        // build sql query
        $sql = "INSTERT INTO ducks (name, favorite_foods, bio) VALUES ('$name', '$favorite_foods', '$bio', '$image_file')";
    
        //execute query in mysql
        if (mysqli_query($conn, $sql)) {
    
            // connection and query are successful
    
        // load homepage
        header("Location: ./index.php");
        } else {
    
      // connection or query have failed with an error. We want to see the error.
    
       echo "Error: " . $sql . "<br />" . mysqli_error($conn); 
                    
    
        }
    }
}


    
   
// create error array


?>

<!DOCTYPE html>
<html lang="en">

<?php include('./components/nav.php');?>
<?php include('./components/head.php');?>

<?php $page_title = "Contact";?>

   <main>

      <h3>Create a Duck!</h3>

        <div class="name">
            <form action="./create-duck.php" id="name" method="POST">

                <div class="name">
                    <label for="name">Duck Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name.." required>
                </div>

                <?php if (isset($errors['name'])) {
                    echo "<div class='error'>" . $errors["name"] . "</div>";
                }?>

                
                <label for="favorite_foods">Favorite Foods</label>
                <input type="text" id="favfoods" name="favorite_foods" placeholder="Favorite foods.." required>

                <div class="upload">
                <label for="image">Duck Photo</label>
                <?php 
                    if (isset($errors['img_src'])) {
                    echo "<div class='error'>" . $errors["img_Src"] . "</div>";
                }
                ?>
                    <input type="file" id="image" name="img_src">
                </div>
                
                
                <div class="bio">
                  <label for="biography">Biography</label>
                    <textarea id="subject" name="biography" placeholder="Tell us about your duck.." style="height:200px" required></textarea>
                    <input type="submit" value="Submit">
                </div> 
             
            </form>
        </div> 
</main>       




<?php include('./components/footer.php');?>