<?php include('./components/nav.php');?>
<?php include('./components/head.php');?>

<? php 

if (isset($_POST ['submit'])) {

    $name = htmlspecialchars($_POST(['name'])); 
    $email = htmlspecialchars($_POST(['email'])); 
    $message = htmlspecialchars($_POST(['message']));

    echo $name . ", " . $email . ", " . $message;
}
?>

    <main>

      <h3>Create a Duck!</h3>

        <div class="contact">
            <form action="./contact.php" method="POST">
                <label for="fname">Name</label>
                <input type="text" id="name" name="name" placeholder="Your name..">

                <label for="lname">Favorite Foods</label>
                <input type="text" id="favfoods" name="favfoods" placeholder="Favorite foods..">
            <div class="upload">
                <input type="submit" value="Upload Image">
            </div>
            
                <label for="subject">Subject</label>
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
            
                <input type="submit" value="Submit">
          
            </form>
        </div> 
             
      </main>



<?php include('./components/footer.php');?>