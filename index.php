<?php
        // Database connection
        define("DB_HOST","localhost");
        define("DB_USER","root");
        define("DB_PASS","");
        define("DB_NAME","salon");

        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        error_reporting(0);
        session_start();

        // Rest of your PHP code...

        // Login Form Processing
        if (isset($_POST['sub'])) {
            $name = $_POST['username'];
            $pass = sha1($_POST['password']);
            $sql = "SELECT * FROM users WHERE username='$name' AND password='$pass'";
            $query = mysqli_query($conn, $sql);
            if ($r = mysqli_fetch_array($query)) {
                $pos = $r['position'];
            }
            $count = mysqli_num_rows($query);
            if ($count == 1) {
                $_SESSION['user'] = $name;
                if ($pos == 'Receptionist') {
                    header("Location: Customer/");
                } else {
                    header("Location: Customer/");
                }
            } else {
                echo "
                <div class='alert alert-danger' id='alert'>
                <a href='#' data-dismiss='alert' class='close'>&times</a>
                <strong>Error!!!</strong>Login Failed, Try Again
                </div>
                ";
            }
        }

        // Registration Form Processing
        if (isset($_POST['sign'])) {
            $name = $_POST['fname'];
            $sname = $_POST['sname'];
            $username = $_POST['uname'];
            $email = $_POST['uemail'];
            $pass = sha1($_POST['pass']);
            $cpass = sha1($_POST['cpass']);
            $id = $_POST['id'];
            $tel = $_POST['tel'];
            if ($pass != $cpass) {
                echo "
                <div class='alert alert-danger' id='alert'>
                <a href='#' data-dismiss='alert' class='close'>&times</a>
                <strong>Error!!!</strong>Your Passwords Do Not Match
                </div>
                ";
            } else {
                // Adjusted SQL query to insert data into the 'users' table
                $sql = "INSERT INTO users (fname, sname, username, email, password, c_id, c_tel, type)
                        VALUES ('$name', '$sname', '$username', '$email', '$pass', '$id', '$tel', 'Customer')";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    echo "
                    <div class='alert alert-success' id='alert'>
                    <a href='#' data-dismiss='alert' class='close'>&times</a>
                    <strong>Success</strong>You are Now Registered. Please Login To Continue
                    </div>
                    ";
                } else {
                    echo "
                    <div class='alert alert-danger' id='alert'>
                    <a href='#' data-dismiss='alert' class='close'>&times</a>
                    <strong>Error!!!</strong>Registration Failed, Try Again
                    </div>
                    ";
                }
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>SMS | Login</title>
  <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="Assets/css/custom.css">
  <link rel="stylesheet" href="Assets/css/all.min.css">
  <script src="Assets/js/jquery.min.js"></script>
  <script src="Assets/js/bootstrap.js"></script>
  <style>
    body {
        background: linear-gradient(135deg, #dbe6f6, #c5796d);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background: #004080;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        color: white;
        flex-wrap: wrap;
    }

    .navbar a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .navbar a:hover {
        color: #ffc107;
    }

    .navbar h1 {
        flex-grow: 1;
        text-align: center;
        font-size: 24px;
        margin: 10px 0;
    }

    .container {
        max-width: 500px;
        margin: 30px auto;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 30px 40px;
        display: none;
    }

    #header {
        font-size: 32px;
        font-weight: bold;
        color: #004080;
        text-align: center;
        margin-bottom: 25px;
        text-shadow: 1px 1px #999;
    }

    .label-control {
        font-weight: 600;
        margin-top: 10px;
        display: block;
        color: #333;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="number"] {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .btn-block {
        width: 100%;
        padding: 12px;
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
        background-color: #004080;
        color: white;
        border: none;
        border-radius: 8px;
        transition: background 0.3s ease;
    }

    .btn-block:hover {
        background-color: #003366;
    }

    .show-signup {
        text-align: center;
        display: block;
        margin-top: 15px;
        color: #004080;
        font-weight: bold;
        text-decoration: underline;
        cursor: pointer;
    }

    .signup-form {
        display: none;
    }

    .services-gallery {
        max-width: 1100px;
        margin: 40px auto;
        text-align: center;
    }

    .services-gallery h2 {
        font-size: 28px;
        color: #004080;
        margin-bottom: 20px;
        text-shadow: 1px 1px #ccc;
    }

    .services-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .service-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        width: 250px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding-bottom: 15px;
    }

    .service-card img {
        width: 100%;
        height: 170px;
        object-fit: cover;
    }

    .service-card p {
        font-weight: 600;
        margin: 10px 0 5px;
        color: #333;
    }

    .service-card label {
        display: block;
        font-weight: normal;
        color: #555;
        margin-bottom: 5px;
    }

    .proceed-btn {
        margin: 20px auto;
        display: block;
        background: #004080;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .proceed-btn:hover {
        background: #003366;
    }

    @media (max-width: 576px) {
        .container {
            padding: 20px;
        }

        .navbar h1 {
            font-size: 18px;
        }

        .services-grid {
            flex-direction: column;
            align-items: center;
        }
    }
  </style>

  <script>
    function showSignUpForm() {
      $('.signup-form').show();
      $('.show-signup').hide();
    }

    function showLoginIfServicesSelected() {
      let anyChecked = $('input[name="services[]"]:checked').length > 0;
      if (anyChecked) {
        $('.container').slideDown();
        $('html, body').animate({
          scrollTop: $(".container").offset().top
        }, 500);
      } else {
        alert("Please select at least one service to proceed.");
      }
    }
  </script>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <a href="admin">Admin</a>
    <h1>Melly's Salon Management System</h1>
    <a href="Employee">Employee</a>
  </div>
<?php
// dbconnect.php: Establish a database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "salon";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Our Services</title>
   
</head>
<body>
    <div class="services-gallery">
        <h2>Explore Our Services</h2>
        <form id="serviceForm">
            <div class="services-grid">
                <?php
                // Query to fetch services from the database
                $sql = "SELECT * FROM services";
                $result = $conn->query($sql);

                // Check if any services exist in the database
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // If the image exists, use it; otherwise, use a default one
                        $imagePath = !empty($row['image']) ? 'Assets/images/' . $row['image'] : 'Assets/images/default.jpg';
                        echo '<div class="service-card">';
                        echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($row['name']) . '">';
                        echo '<p>' . htmlspecialchars(ucwords($row['name'])) . ' - Ksh ' . number_format($row['price'], 2) . '</p>';
                        echo '<label><input type="checkbox" name="services[]" value="' . htmlspecialchars($row['name']) . '" data-id="' . $row['service_id'] . '" data-name="' . htmlspecialchars($row['name']) . '" data-description="' . htmlspecialchars($row['description']) . '" data-price="' . $row['price'] . '" data-duration="' . $row['duration'] . '" onchange="showServiceDetails(this)"> Select</label>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No services available at the moment.</p>';
                }
                ?>
            </div>
            <button type="button" class="proceed-btn" onclick="showLoginIfServicesSelected()">Proceed to Login</button>
        </form>

        <!-- Div to show service details dynamically -->
        <div id="serviceDetails" class="service-details">
            <h3 id="serviceTitle"></h3>
            <p><strong>Description: </strong><span id="serviceDescription"></span></p>
            <p><strong>Duration: </strong><span id="serviceDuration"></span> minutes</p>
            <p><strong>Price: </strong><span id="servicePrice"></span></p>
        </div>
    </div>

    <script>
        function showLoginIfServicesSelected() {
            // Get all checked checkboxes
            const checkboxes = document.querySelectorAll('input[name="services[]"]:checked');
            
            // If no services are selected, alert the user
            if (checkboxes.length === 0) {
                alert('Please select at least one service.');
                return;
            }
            
            // Redirect the user to the login page (you can change this to another page if necessary)
            window.location.href = 'login.php'; 
        }

        // Function to show service details when a checkbox is selected
        function showServiceDetails(checkbox) {
            const serviceDetailsDiv = document.getElementById('serviceDetails');
            const title = document.getElementById('serviceTitle');
            const description = document.getElementById('serviceDescription');
            const duration = document.getElementById('serviceDuration');
            const price = document.getElementById('servicePrice');

            // If the checkbox is checked, show details
            if (checkbox.checked) {
                title.textContent = checkbox.getAttribute('data-name');
                description.textContent = checkbox.getAttribute('data-description');
                duration.textContent = checkbox.getAttribute('data-duration');
                price.textContent = 'Ksh ' + checkbox.getAttribute('data-price');

                serviceDetailsDiv.style.display = 'block'; // Show the details div
            } else {
                serviceDetailsDiv.style.display = 'none'; // Hide the details div if checkbox is unchecked
            }
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>


  <!-- Login/Sign Up Forms -->
  <div class="container">
    <!-- Login Form -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset>
        <legend id="header">Login</legend>
        <label class="label-control">Username</label>
        <input type="text" name="username" required placeholder="Enter Username">
        <label class="label-control">Password</label>
        <input type="password" name="password" required placeholder="Enter Password">
        <button type="submit" class="btn btn-block" name="sub">Login</button>
        <a class="show-signup" onclick="showSignUpForm()">Not a member? Sign Up</a>
      </fieldset>
    </form>

    <!-- Signup Form -->
    <form class="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <fieldset>
        <legend id="header">Sign Up</legend>
        <label class="label-control">First Name</label>
        <input type="text" name="fname" required>
        <label class="label-control">Last Name</label>
        <input type="text" name="sname" required>
        <label class="label-control">Username</label>
        <input type="text" name="uname" required>
        <label class="label-control">Email</label>
        <input type="email" name="uemail" required>
        <label class="label-control">Password</label>
        <input type="password" name="pass" required>
        <label class="label-control">Confirm Password</label>
        <input type="password" name="cpass" required>
        <label class="label-control">ID Card Number</label>
        <input type="number" name="id" required>
        <label class="label-control">Telephone Number</label>
        <input type="number" name="tel" required>
        <button type="submit" class="btn btn-block" name="sign">Sign Up</button>
      </fieldset>
    </form>
  </div>
</body>
</html>