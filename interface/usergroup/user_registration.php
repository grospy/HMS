<?php


/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'shamil');
define('DB_PASSWORD', '');
define('DB_NAME', 'openemr');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// Do not touch the upstairs _____( |__0__ ___0__| ) 
 
// Define variables and initialize with empty values
$federaltaxid = $federaldrugid = $upin = "";
$mname = $lname = $suffix = "";
$info = $source = $fname = "";
$id = $password = $authorized = "";
$username = $address = $salary = "";
$mname = $name = "";

$name_err = $address_err = $salary_err = "";
$dob = $gender = $reg_type = "";

// we defined all variables that can be needed
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    $input_name = trim($_POST["username"]);
    if(empty($input_name)){
        $name_err = "Please enter a username.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid username.";
    } else{
        $name = $input_name;
    }


    // Validate address
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter a password.";     
    } else{
        $password = $input_password;
    }
    
    // Validate address
    $input_fname = trim($_POST["first_name"]);
    if(empty($input_fname)){
        $fname_err = "Please enter a First Name.";     
    } else{
        $fname = $input_fname;
    }


    $input_lname = trim($_POST["last_name"]);
    if(empty($input_lname)){
        $lname_err = "Please enter a last name.";     
    } else{
        $lname = $input_lname;
    }

    $input_mname = trim($_POST["middle_name"]);
    if(empty($input_mname)){
        $mname_err = "Please enter a middle name name.";     
    } else{
        $mname = $input_mname;
    }

    //Under construction

    // Validate date of birth
    $input_federaltaxid = trim($_POST["federaltaxid"]);
    if(empty($input_federaltaxid)){
        $federaltaxid_err = "Please enter a valid federal tax id.";     
    } else{
        $federaltaxid = $input_federaltaxid;
    }

    // Validate federaldrugid
    $input_federaldrugid = trim($_POST["federaldrugid"]);
    if(empty($input_federaldrugid)){
        $federaldrugid_err = "Please enter a valid federal drug id.";     
    } else{
        $federaldrugid = $input_federaldrugid;
    }

     // Validate date of birth
     $input_upin = trim($_POST["upin"]);
     if(empty($input_upin)){
         $upin_err = "Please enter a valid upin.";     
     } else{
        $upin = $input_upin;
     }
    

     /*
     
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err) && empty($dob) && empty($gender) && empty($reg_type) ){
        // Prepare an insert statement
       // $sql = "INSERT INTO employees (name, address, salary, DOB, gender, reg_type) VALUES ('$name', '$address', '$salary', '$dob', '$gender' , '$reg_type')";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary,$param_dob, $param_gender , $param_reg_type);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_dob = $dob;
            $param_gender = $gender;
            $param_reg_type = $reg_type;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    */
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <textarea name="password" class="form-control"><?php echo $password; ?></textarea>
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $fname; ?>">
                            <span class="help-block"><?php echo $fname_err;?></span>
                        </div>

                        <!-- NEW STUFF -->
                        <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $lname; ?>">
                            <span class="help-block"><?php echo $lname_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="<?php echo $gender; ?>">
                            <span class="help-block"><?php echo $gender_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($federaltaxid_err)) ? 'has-error' : ''; ?>">
                            <label>Federal Tax ID</label>
                            <input type="text" name="federaltaxid" class="form-control" value="<?php echo $federaltaxid; ?>">
                            <span class="help-block"><?php echo $federaltaxid_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($federaldrugid_err)) ? 'has-error' : ''; ?>">
                            <label>Federal Drug ID</label>
                            <input type="text" name="federaldrugid" class="form-control" value="<?php echo $federaldrugid; ?>">
                            <span class="help-block"><?php echo $federaldrugid_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($upin_err)) ? 'has-error' : ''; ?>">
                            <label>UPIN</label>
                            <input type="text" name="upin" class="form-control" value="<?php echo $upin; ?>">
                            <span class="help-block"><?php echo $upin_err;?></span>
                        </div>

                        <input type="submit" name="mybutton" class="btn btn-primary" value="Submit">
                        <a href="http://localhost:8888/HMS/interface/login/login.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


<?php

// This code grabs the values form the above form and puts them into the database
// First it connected to the database gives the details below.
$servername = "localhost";
$username = "shamil";
$password = "";
$dbname = "openemr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["mybutton"]))
{

    //$sql = "INSERT INTO employees (name, address, salary, DOB, gender, reg_type) VALUES ('$name', '$address', '$salary', '$dob', '$gender' , '$reg_type')";
    
    //Query that worked just now : INSERT INTO users ( username, password, fname, mname, lname, federaltaxid, federaldrugid, upin) VALUES ('Loki','12345','Lakamoto','Torio','M','51412213','543634324','16452342')
    //INSERT INTO users ( username, password, fname, mname, lname, federaltaxid, federaldrugid, upin) VALUES ('$name','$password','$fname','$mname','$lname','$federaltaxid','federaldrugid','upin')
    $sql = "INSERT INTO users ( username, password, fname, mname, lname, federaltaxid, federaldrugid, upin) VALUES ('$name','$password','$fname','$mname','$lname','$federaltaxid','$federaldrugid','$upin')";
    
    
    echo $_POST["mybutton"];
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>