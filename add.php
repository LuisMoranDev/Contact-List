<?php 
    include('config/db_connect.php');
    $firstName = $lastName = $email = $description = ''; 
    $errors = ['firstName' => '', 'lastName' => '','email' => '','description' => ''];


    if(isset($_POST['submit'])){

        if(empty($_POST['firstName'])){
            $errors['firstName'] = 'A first name is required';
        } else{
            $firstName = $_POST['firstName'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $firstName)){
            $errors['firstName'] = 'First name must be letters';
            }   
        }

        if(empty($_POST['lastName'])){
            $errors['lastName'] = 'A last name is required';
        } else{
            $lastName = $_POST['lastName'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $lastName)){
            $errors['lastName'] = 'Last name must be letters';
            }   
        }

        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required';
        } else{
            $email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
        }

        if(empty($_POST['description'])){
            $errors['description'] = 'A description is required';
        } else{
            $description = $_POST['description'];  
        }

        if(array_filter($errors)){
            //echo 'errors in form'
        }
        else{
            $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
            $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            $sql = "INSERT INTO contacts(firstName, lastName, email, description) VALUES('$firstName','$lastName', '$email', '$description')"; 

            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            }else{
                echo 'query error: '.mysqli_error($conn); 
            }
        }
  
    }

?> 

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php')?>

<section class="container shadow">
    <h2 class="form-title">Add Contact</h2>
    <form class="add-form" action="add.php" method="POST">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" class="form-control" name="firstName" value="<?php echo htmlspecialchars($firstName);?>">
                <div class="text-body"><?php echo $errors['firstName']; ?></div>
          </div>  
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" class="form-control" name="lastName" value="<?php echo htmlspecialchars($lastName);?>">
                <div class="text-body"><?php echo $errors['lastName']; ?></div>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email);?>">
                <div class="text-body"><?php echo $errors['email']; ?></div>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($description);?>">
                <div class="text-body"><?php echo $errors['description']; ?></div>
            </div>  
        <input type="submit" name="submit" value="submit" class="btn form-btn mx-auto">
    </form>
</section> 

</body>
</html>