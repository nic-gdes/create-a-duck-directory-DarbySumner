<?php 
require('./config/db.php'); // Create your database connection

// get url query parameters
$duck = $_GET['id']; 
// use the $_GET superglobal to access URL parameters, specifically the "id" parameter
echo $duck;
$duck_is_live = false;

if (isset($_GET['id'])) {
    //Assign a variable to the id
    $id = htmlspecialchars($_GET['id']);
    // Get duck info from database
    // Connect to db
    require('./config/db.php');

    // Create a query to select the intended duck from the db
    $sql = "SELECT id, name, favorite_foods, bio, img_src FROM ducks WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $duck = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('./components/nav.php');?>
<?php include('./components/head.php');?>

<main>
    <?php if ($duck_is_live) :?>

        <div class="card-profile">
           
            <div class="image">
                <img src="<?php echo $duck['img_src'];?>" alt="duck1" width="200px">
                    <div class="container-2">
                        <h4><b>Duck Name</b></h4> 
                        <p>Favorite Foods</p>
                        <p>Item 1</p>
                        <p>Item 2</p>
                        <p>Item 3</p>
                    </div>
            </div>
    
    
    <?php else : ?>

        <section class ="no duck">
            <h1>Sorry, this duck does not exist</h1>
        </section>

    <?php endif ?>

</main>
<?php include('./components/footer.php');?>