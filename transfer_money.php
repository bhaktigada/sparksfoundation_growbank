<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title>Transfer</title>
        <link rel="stylesheet" href="css/transfer.css">
        <script src="https://unpkg.com/htmlincludejs"></script>
    </head>
    <body>
        <div>
            <include src="./header.html"></include>
        </div>
        <main class="div1">
                <table>
                  <caption class="des">User Data</caption>
                  <thead>
                    <tr>
                      <th>Customer Id</th>
                      <th>Customer Name</th>
                      <th>E-Mail</th>
                      <th>Current Balance (Rs)</th>
                      <th>Transfer</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $conn = new mysqli('localhost','root','','bank');
                  if(!$conn)
                    {
                      die('Could not Connect MySql Server');
                    }
                  $result = (mysqli_query($conn,"select * from users"));
                  while ($row = mysqli_fetch_array($result)) 
                  {
                  ?>
                    <tr>
                      <td><?php echo $row["Id"]; ?></td>
                      <td><?php echo $row["Name"]; ?></td>
                      <td><?php echo $row["Email"]; ?></td>
                      <td><?php echo $row["Balance"]; ?></td>
                      <td><a href="transaction.php?id=<?= $row["Id"]; ?>"><button class="btn">Transfer</button></a></td>
                    </tr>
                  </tbody>
                  <?php
                }
                ?>
                </table>
            </main>
            <div>
            <include src="./footer.html"></include>
            </div>
    </body>
</html>
