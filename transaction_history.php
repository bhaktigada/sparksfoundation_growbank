<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title>Transfer</title>
        <link rel="stylesheet" href="css/trans_history.css">
        <script src="https://unpkg.com/htmlincludejs"></script>
    </head>
    <body>
        <div>
            <include src="./header.html"></include>
        </div>
        <main class="div1">
                <table>
                  <caption class="des">Transaction History</caption>
                  <thead>
                    <tr>
                      <th>Sr. no.</th>
                      <th>Sender</th>
                      <th>Receiver</th>
                      <th>Amount Transferred (Rs)</th>
                      <th>Date</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $conn = new mysqli('localhost','root','','bank');
                  if(!$conn)
                    {
                      die('Could not Connect MySql Server');
                    }
                  $result = (mysqli_query($conn,"select * from transaction"));
                  while ($row = mysqli_fetch_array($result)) 
                  {
                  ?>
                    <tr>
                      <td><?php echo $row["no"]; ?></td>
                      <td><?php echo $row["sender"]; ?></td>
                      <td><?php echo $row["receiver"]; ?></td>
                      <td><?php echo $row["amount"]; ?></td>
                      <td><?php echo $row["date"]; ?></td>
                      <td><?php echo $row["time"]; ?></td>
                    </tr>
                  </tbody>
                  <?php
                }
                ?>
                </table>
                
            </main>
            <div style="padding-top: 170px; background-color: rgb(201, 226, 235);">
            <include src="./footer.html"></include>
            </div>
    </body>
</html>
