<?php 
    include('config/db_connect.php'); 

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM contacts WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
    }

    $sql = 'SELECT firstName, lastName, email, description, id FROM contacts
    ORDER by created_at';

    $result = mysqli_query($conn, $sql); 

    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC); 

    mysqli_free_result($result); 

    mysqli_close($conn); 

?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php')?>
<div class="container-fluid">
    <div class="row">
        <?php foreach($contacts as $contact): ?>
         <div class="col-12 col-sm-12 col-md-6 contact-card">
            <div class="card">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($contact['firstName'] . ' ' . $contact['lastName']) ?></h5>
                    <p class="card-text">Email: <?php echo htmlspecialchars($contact['email']);  ?> <br />
                    Description: <?php echo htmlspecialchars($contact['description']); ?>
                    </p>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $contact['id']; ?>">
                        <input type="submit" name="delete" value="Delete" class="btn delete-btn">
                    </form>
                </div>
            </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
    
</body>
</html>

<!-- style="width: 20rem; height: 200px" -->