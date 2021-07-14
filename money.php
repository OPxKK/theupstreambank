<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Upstream Bank/Money Transfer</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="money.css">
<link rel="icon" href="favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

<body>

  <?php
  include 'connect.php';
  $sql = "SELECT * FROM customer_details";
  $mysqli_result = mysqli_query($conn, $sql);
  ?>

  <div id="first-container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">The Upstream Bank</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#middle-container">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#second-container">Activity Section</a>
            </li>
          </ul>
        </div>
      </div>
  </div>
  </nav>
  <div id="second-container">
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive-sm">
          <h1 class="heading-money-transfer">Click on the View and Transact Button to transfer funds!</h1>
          <br>

          <table class="table table-hover table-striped table-sm">
            <thead style="color : black;" class="table-danger">
              <tr>
                <th scope="col" class="text-center py-2">Sr No</th>
                <th scope="col" class="text-center py-2">Customer Name</th>
                <th scope="col" class="text-center py-2">E-Mail</th>
                <th scope="col" class="text-center py-2">Phone Number</th>
                <th scope="col" class="text-center py-2">Balance</th>
                <th scope="col" class="text-center py-2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($rows = mysqli_fetch_assoc($mysqli_result)) {
              ?>
                <tr style="color : black;">
                  <td class="text-center py-2">
                    <?php echo $rows['id'] ?>
                  </td>
                  <td class="text-center py-2">
                    <?php echo $rows['customer_name'] ?>
                  </td>
                  <td class="text-center py-2">
                    <?php echo $rows['email'] ?>
                  </td>
                  <td class="text-center py-2">
                    <?php echo $rows['phone_number'] ?>
                  </td>
                  <td class="text-center py-2">
                    <?php echo $rows['balance'] ?>
                  </td>
                  <td><a href="customers.php?id=<?php echo $rows['id']; ?>"> <button class="btn btn-outline-dark btn">View and Transact</button></a></td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>


</body>

</html>