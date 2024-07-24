<?php
session_start();
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': light }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create account - Platform Productions</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="assets/js/init-alpine.js"></script>
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>

<body>
  <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
          <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="assets/img/create-account-office.jpeg" alt="Office" />
          <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="assets/img/create-account-office-dark.jpeg" alt="Office" />
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
          <div class="w-full">
          <center>
            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
              Create account
            </h1>
            <form method="post">
            <span style="color:red" id="error"></span></center>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input id="name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" placeholder="Full Name" name="name" required />
              </label>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input id="email"class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="email" placeholder="Email Address" name="email" required />
              </label>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Contact Number</span>
                <input id="contact" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="number" placeholder="10 Digits Contact Number" name="number" required />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" name="password" required />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Confirm password
                </span>
                <input id="cpassword" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" name="cpassword" required />
              </label>


              <input type="submit" value="Create Account" name="create" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" />
            </form>
            <hr class="my-8" />

            <p class="mt-4">
              <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="./login.php">
                Already have an account? Login
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('../db.php');
  
  if (isset($_POST["create"])) {

    $name = $_POST["name"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    echo "<script>document.querySelector('#name').value='$name';</script>";
    echo "<script>document.querySelector('#email').value='$email';</script>";
    echo "<script>document.querySelector('#contact').value='$number';</script>";
    echo "<script>document.querySelector('#password').value='$password';</script>";
    echo "<script>document.querySelector('#cpassword').value='$cpassword';</script>";

    $search = "SELECT COUNT(`Email`) as 'Users' FROM `user_login` WHERE `Email`=:email";
    $stmt = $con->prepare($search);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $allusers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($allusers as $row) {
      $flag = $row["Users"];
    }
    if(strlen($number)<10 || is_numeric($name) || is_numeric($email))
    {
      echo "<script>document.querySelector('#error').innerHTML='Please enter valid details!';</script>";
    }
    else if($password!=$cpassword)
    {
      echo "<script>document.querySelector('#error').innerHTML='Passwords do not match!';</script>";
    }
    else if(strlen($password)<6)
    {
      echo "<script>document.querySelector('#error').innerHTML='Password must be at least 6 characters long!';</script>";
    }
    else if($flag!="0" || $flag!=0)
    {
      echo "<script>document.querySelector('#error').innerHTML='Email ID already exists!';</script>";
    }
    else
    {
      $query = "SELECT * FROM `user_login`";
      $stmt = $con->prepare($query);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      foreach ($data as $row) {
        $user = $row["User_ID"];
      }

      $num = substr($user, 1);
      //die($num);
      $user_id1 = $num + 1;
      $user_id = "U".$user_id1;
      //die($user_id);
    } else {
      $user_id = "U101";
    }

    $ins = "INSERT INTO `user_login`(`User_ID`, `Name`, `Password`, `Email`, `Contact_No`) VALUES (:userid,:name,:password,:email,:contact);";
    $stmt = $con->prepare($ins);
    $stmt->bindParam(':userid', $user_id);
    $stmt->bindParam(':contact', $number);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $success = $stmt->execute();
    if ($success) {
      $_SESSION["user"] = $user_id;
      $_SESSION["name"] = $name;
      echo "<script>window.location.href='../';</script>";
    }
    else
    {
        echo "<script>document.querySelector('#error').innerHTML='Something Went Wrong!';</script>";
    }
    }
  }
  ?>
</body>

</html>