<html>
    <head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
</html>

<?php
$conn = new mysqli('localhost','root','','bank');
if(!$conn)
    {
    die('Could not Connect MySql Server');
    }
if(isset($_POST['submit']))
{
    $sid = $_GET['id'];
    $rid = $_POST['transfer_to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$sid";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where Id=$rid";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);


    //check input of negative amount
    if (($amount)<0)
    {
        ?>
        <script>
            swal("Oops!", "The value entered is negative", "error",{buttons:false});
            setTimeout(function (){
                window.location='transfer_money.php';
                },2050);
        </script>

        <?php
    }

    // check insufficient balance.
    else if($amount > $sql1['Balance'])
    {

        ?>
        <script>
            swal("Insufficient Balance", "Transaction Not  Successful!", "warning");
            setTimeout(function (){
                window.location='transfer_money.php';
                },2050);
        </script>

        <?php
    }



    //check zero values
    else if($amount == 0)
    {
        ?>
        <script>
            swal("Oops!","The value entered is zero", "error");
            setTimeout(function (){
                window.location='transfer_money.php';
                },2050);
        </script>

        <?php
    }


    else {

        // deducting amount from sender's account
        $newbalance = $sql1['Balance'] - $amount;
        $sql = "UPDATE users set Balance=$newbalance where id=$sid";
        mysqli_query($conn,$sql);


        // adding amount to reciever's account
        $newbalance = $sql2['Balance'] + $amount;
        $sql = "UPDATE users set Balance=$newbalance where Id=$rid";
        mysqli_query($conn,$sql);

    
        if($query){
            ?>
            <script>
                swal("Success","Transaction Successful!","success",{buttons:false});
                setTimeout(function (){
                    window.location='transaction_history.php';
                },2050);
            </script>
            <?php
        }

        $sender = $sql1['Name'];
        $receiver = $sql2['Name'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
        $query=mysqli_query($conn,$sql);
        $newbalance= 0;
        $amount =0;
    }
}
?>
