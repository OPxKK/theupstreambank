<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Upstream Bank</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="customers.css">
<link rel="icon" href="favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

<body>
    <?php
    include 'connect.php';

    if (isset($_POST['submit'])) {
        $from = $_GET['id'];
        $to = $_POST['to'];
        $amount = $_POST['amount'];

        $sql = "SELECT * from customer_details where id=$from";
        $query = mysqli_query($conn, $sql);
        $sql1 = mysqli_fetch_array($query);

        $sql = "SELECT * from customer_details where id=$to";
        $query = mysqli_query($conn, $sql);
        $sql2 = mysqli_fetch_array($query);



        //Conditions
        //For negative value
        if (($amount) < 0) {
            echo '<script type="text/javascript">';
            echo ' alert("Negative value cannot be transferred !")';
            echo '</script>';
        }
        //Insufficient balance
        else if ($amount > $sql1['balance']) {

            echo '<script type="text/javascript">';
            echo ' alert("Sorry! you have insufficient balance !")';
            echo '</script>';
        }
        //For 0 (zero) value
        else if ($amount == 0) {

            echo "<script type='text/javascript'>";
            echo "alert('Zero value cannot be transferred !')";
            echo "</script>";
        } else {
            $newbalance = $sql1['balance'] - $amount;
            $sql = "UPDATE customer_details set balance=$newbalance where id=$from";
            mysqli_query($conn, $sql);

            $newbalance = $sql2['balance'] + $amount;
            $sql = "UPDATE customer_details set balance=$newbalance where id=$to";
            mysqli_query($conn, $sql);

            $sender = $sql1['customer_name'];
            $receiver = $sql2['customer_name'];
            $sql = "INSERT INTO transaction_details(`sender`, `recipent`, `balance`) VALUES ('$sender','$receiver','$amount')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo "<script> alert('Transaction Successfully !');
                                     window.location='history.php';
                           </script>";
            }

            $newbalance = 0;
            $amount = 0;
        }
    }
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
        <h2 class="text-center pt-4" style="color : black;">Customer Details</h2>
        <?php
        include 'connect.php';
        $sid = $_GET['id'];
        $sql = "SELECT * FROM customer_details where id=$sid";
        $mysqli_result = mysqli_query($conn, $sql);
        if (!$mysqli_result) {
            echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        }
        $rows = mysqli_fetch_assoc($mysqli_result);
        ?>
        <form method="post" name="tcredit" class="tabletext"><br>
            <div>
                <table class="table table-striped table-hover">
                    <tr style="color : black;" class="table-primary">
                        <th class="text-center">Sr No</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Phone Number</th>
                    </tr>
                    <tr style="color : black;">
                        <td class="py-2"><?php echo $rows['id'] ?></td>
                        <td class="py-2"><?php echo $rows['customer_name'] ?></td>
                        <td class="py-2"><?php echo $rows['email'] ?></td>
                        <td class="py-2"><?php echo $rows['balance'] ?></td>
                        <td class="py-2"><?php echo $rows['phone_number'] ?></td>
                    </tr>
                </table>
            </div>
            <h2 class="text-center pt-4" style="color : black;">Transfer Money Here !</h2>
            <label style="color : black;"><strong>Transfer To:</strong></label>
            <select name="to" class="form-control" required>
                <option value="" disabled selected>Choose</option>
                <?php
                include 'connect.php';
                $sid = $_GET['id'];
                $sql = "SELECT * FROM customer_details where id!=$sid";
                $mysqli_result = mysqli_query($conn, $sql);
                if (!$mysqli_result) {
                    echo "Error " . $sql . "<br>" . mysqli_error($conn);
                }
                while ($rows = mysqli_fetch_assoc($mysqli_result)) {
                ?>
                    <option class="table" value="<?php echo $rows['id']; ?>">

                        <?php echo $rows['customer_name']; ?> (Balance:
                        <?php echo $rows['balance']; ?> )

                    </option>
                <?php
                }
                ?>
                <div>
            </select>
            <br>
            <br>
            <label style="color : black;"><strong>Amount:</strong></label>
            <input type="number" class="form-control" name="amount" required>
            <br><br>
            <div class="text-center">
                <button class="btn btn-dark mb-3" name="submit" type="submit" id="myBtn">Fill the Amount and Transfer</button>
            </div>
        </form>
    </div>

    <script src="index.js"></script>

</body>

</html>