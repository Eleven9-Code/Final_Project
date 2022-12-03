<?php
    include_once 'header.php';
?>
<body>
       <form action="includes/signup.inc.php" method="post">
        <div class="title">
          <i class="fas fa-pencil-alt"></i> 
          <h2>SIGNUP</h2>
        </div>



        <div class="info">
          <input class="fname" type="text" name="userFName" placeholder="Full name">
          <input type="text" name="userEmail" placeholder="email">
          <input type="text" name="userPass" placeholder="email">
          <input type="text" name="userMailing" placeholder="Mailing">
          <input type="text" name="userBiling" placeholder="Billing">
          <input type="text" name="userPayment" placeholder="paymetn">
        </div>
        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </body>
</html>