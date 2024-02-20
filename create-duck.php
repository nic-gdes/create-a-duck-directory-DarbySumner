
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
    
        $errors['name'] = "A name is required.";}

    } else {
        //if the name is not empty

        if(!preg_match('/^[a-z\s]+$/i', $name)) { 
            // "echo there is a name";
    
        $errors["name"] = "This name has illegal characters";}
   

    if(empty($favorite_foods)) {

        $errors['datalist'] = "No fav foods? weirdo";}

    } else {

    if(!preg_match('/^[a-z,\s]+$/i', $favorite_foods)) {

    
        $errors["datalist"] = "The name must have a comma between items";}
        
}
  
// check if bio is empty
if(empty($message)) {
    $errors["message"] = "A bio is required";
}


if(!array_filter($errors)) {
    // everything is good, form is valid

    // connect ot the database
    require('./config/db.php');

    // build sql query
    $sql = "INSTERT INTO ducks (name, favorite_foods, bio) VALUES ($name, $favorite_foods, $bio)";

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
            <ol>
                <li><label for="name">Duck Name</label>
                <div class="error">A name is required</div>

                <?php if (isset($errors['name'])) {
                    echo "<div class='error'>" . $errors["name"] . "</div>";
                }
                ?>

                <input type="text" id="name" name="name" placeholder="Your name.." required <?php if(
                    isset($name)) { echo $name; } ?>
                ></li>
                
                <li><label for="favorite_foods">Favorite Foods</label>
                <input type="text" id="favfoods" name="favorite_foods" placeholder="Favorite foods.." required></li>

                <div class="upload">
                   <input type="submit" value="Upload Image">
                </div>
                
                <div class="bio">
                    <li><label for="biography">Biography</label>
                    <textarea id="subject" name="biography" placeholder="Tell us about your duck.." style="height:200px" required></textarea></li>
                    <input type="submit" value="Submit">
                </div> 
            </ol> 
            </form>
        </div> 
</main>       




<?php include('./components/footer.php');?>