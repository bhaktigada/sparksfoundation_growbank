<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title>Transaction</title>
        <link rel="stylesheet" href="css/transaction.css">
        <script src="https://unpkg.com/htmlincludejs"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>

        <div>
            <include src="./header.html"></include>
        </div>
        <main class="div">
                <?php
                    $Id = $_GET['id'];
                    $conn = new mysqli('localhost','root','','bank');
                    if(!$conn)
                        {
                        die('Could not Connect MySql Server');
                        }
                    $result = (mysqli_query($conn,"select * from users where Id='$Id'"));
                    $content = mysqli_fetch_assoc($result);
                  ?>
            <center>
                <div class="fields">
                <fieldset>
                    <legend><b>Customer details</b></legend>
                    <form action="transaction1.php?id=<?= $Id; ?>" method="POST">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value=<?php echo $content["Name"]; ?> disabled><br>
                        <label for="email">Email-Id</label>
                        <input type="email" id="email" name="email" value=<?php echo $content["Email"]; ?> disabled ><br>
                        <label for="balance">Balance (in Rs)</label>
                        <input type="number" id="balance" name="balance" value=<?php echo $content["Balance"]; ?>  disabled ><br>
                        <label for="transfer_to">Transfer to</label>
                        <select id="transfer_to" name="transfer_to">
                        <?php
                        $result = (mysqli_query($conn,"select * from users"));
                        while ($row = mysqli_fetch_array($result)) 
                        {
                            if($content["Name"] != $row["Name"])
                            {
                        ?>
                            <option value="<?php echo $row['Id'];?>"><?php echo $row["Name"]; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select><br>
                        <label for="amount">Amount to transfer (in Rs)</label>
                        <input type="number" id="amount" name="amount"><br><br>
                        <div class="btns">
                            <button type="submit" name="submit">Transfer Money</button>
                        </div><br>
                    </form>
                </fieldset>
                </div>
            </center>
        </main>
        <div>
            <include src="./footer.html"></include>
        </div>
    </body>
</html>

