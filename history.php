<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>The Upstream Bank/Transaction History</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="history.css">
<link rel="icon" href="favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

<body>
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
          </ul>
        </div>
      </div>
  </div>
  </nav>

  <div class="d-grip gap-2 col-6 mx-auto text-center p-3 mb-2">
    <a href="money.php"><button type="button" class="btn btn-warning btn-lg mb-3">Click Here to Transfer Money</button></a>
  </div>



  <div class="table-responsive-sm">
    <table class="table table-hover table-striped">
      <thead style="color : black;" class="table-danger">
        <tr>
          <th class="text-center">S.No.</th>
          <th class="text-center">Sender</th>
          <th class="text-center">Receiver</th>
          <th class="text-center">Amount</th>
          <th class="text-center">Date</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include 'connect.php';

        $sql = "select * from transaction_details";

        $query = mysqli_query($conn, $sql);

        while ($rows = mysqli_fetch_assoc($query)) {
        ?>
          <tr style="color : black;">
            <td class="text-center py-2"><?php echo $rows['id']; ?></td>
            <td class="text-center py-2"><?php echo $rows['sender']; ?></td>
            <td class="text-center py-2"><?php echo $rows['recipent']; ?></td>
            <td class="text-center py-2"><?php echo $rows['amount']; ?> </td>
            <td class="text-center py-2"><?php echo $rows['tr_date']; ?> </td>

          <?php
        }

          ?>
      </tbody>
    </table>

  </div>
  </div>




</body>

</html>