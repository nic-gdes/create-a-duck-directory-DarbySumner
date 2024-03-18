<?php

    // include database connection
    include('./config/db.php');

    // creat SQL Query
    $sql = "SELECT name,favorite_foods,img_src FROM ducks";

    // query the DB and add the result to a php array
    $result = mysqli_query($conn, $sql);
    $ducks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory and close SQL connection
    mysqli_free_result($result);
    mysqli_close($conn);

?>




<!DOCTYPE html>
<html lang="en">

<body>

<?php include('./components/head.php');?>
<?php include('./components/nav.php');?>

<main>
    <div class="welcome">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    </div>

        <?php foreach ($ducks as $duck) : ?>
            
    <div class="card">

        <div>
            <a href='./profile.php'id= <?php echo $duck["id"]?>View this Duck></a>
        </div>

            <img src="<?php echo $duck["img_src"]; ?>" alt="duck1" width="300px" height="300px">

        <div class="container">

            <h4><?php echo $duck["name"]; ?></h4> 

            <?php $foods_list = explode("," , $duck["favorite_foods"]);
            
            ?> 

            <ul class="favorite-foods">

            <?php foreach($foods_list as $food): ?> 
                <li><?php echo $food ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <?php endforeach ?>

</main> 

    <?php include('./components/footer.php'); ?>
    
</body>
</html>