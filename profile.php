<?php
// Create your database connection 
require('./config/db.php'); 

// get url query parameters
$duck_id = $_GET['id']; // use the $_GET superglobal to access URL parameters, specifically the "id" parameter
echo $duck_id;

// use the $_GET superglobal to access URL parameters, specifically the "id" parameter
$duck_is_live = false;

if (isset($_GET['id'])) {

    //sanatize input
    $duck_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Create a query to select the intended duck from the db
    $sql = "SELECT name, favorite_foods, bio, img_src FROM ducks WHERE id = $duck_id";
    $result = mysqli_query($conn, $sql);

    // Fetch results from query
    $duck = mysqli_fetch_assoc($result);

    //Assign a variable to the id
    $id = htmlspecialchars($_GET['id']);

    //Free mysql result and close connection
    mysqli_free_result($result);
    mysqli_close($conn);

    //check if duck is empty = if it has content and mark duck is live as true.
    if (isset($duck["id"])) {
        $duck_is_live = true;
    }


}

// Check if the delete button was clicked
if (isset($_POST['delete'])) {

// Check if the ID parameter is set and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {

// Connect to the database
$conn = new mysqli('favorite_foods', 'bio', 'img_src');

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);

}

// Prepare and execute the SQL query to delete data
$id = $_POST['id'];

$sql = "DELETE FROM ducks WHERE id = $duck_id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); 
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
echo "Record deleted successfully";

} else {
echo "Error: Record not found or could not be deleted";
}

// Close statement and database connection
$stmt->close();
$conn->close();

} else {

echo "Error: ID parameter missing or empty";
}
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
            
        <form action="./profile.php" method="POST">

            <input type="hidden" name="id_to_delete" value="<?php echo $duck['id']; ?>">

            <input type="submit" name="delete" value="Delete Duck">

        </form>
    
    <?php else : ?>

        <section class ="no duck">
            <h1>Sorry, this duck does not exist</h1>
        </section>

    <?php endif ?>

</main>
<?php include('./components/footer.php');?>