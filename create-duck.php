
<?php
// check for post
if (isset($_POST['submit'])) {

   
// create error array
$errors = array(
    "name" => "",
    "favorite_foods" => "",
    "biography" => "",
    );

    $name = htmlspecialchars($_POST['name']); 
    $favorite_foods = htmlspecialchars($_POST['favorite_foods']); 
    $biography = htmlspecialchars($_POST['biography']);

    if(empty($name)) {
        // if the name is empty
        $errors['name'] = "A name is required.";
    } else {
        //if the name is not empty
        if(!preg_match('/^[a-z\s]+$/i', $name)) { 
            $errors["name"] = "The name has illegal characters";
    }

   
    }

    if(preg_match('/^[a-z,\s]+$/i', $favorite_foods)) {
       
    } else {
        $errors["favorite_foods"] = "Favorite foods must be separated by a comma";
    }

    print_r($errors);
}



?>

<!DOCTYPE html>
<html lang="en">

<?php include('./components/nav.php');?>
<?php include('./components/head.php');?>

    <main>

      <h3>Create a Duck!</h3>

        <div class="name">
            <form action="./create-duck.php" id="name" method="POST">

                <label for="name">Duck Name</label>
                <input type="text" id="name" name="name" placeholder="Your name.." required>

                <label for="favorite_foods">Favorite Foods</label>
                <input type="text" id="favfoods" name="favorite_foods" placeholder="Favorite foods.." required>

            <div class="upload">
                <input type="submit" value="Upload Image">
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