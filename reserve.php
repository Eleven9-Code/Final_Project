<?php
    include_once 'header.php'
?>
       <form action="includes/reserve.inc.php" method="post">
        <div class="title">
          <i class="fas fa-pencil-alt"></i> 
          <h2>Register here</h2>
        </div>



        <div class="info">
          <input class="fname" type="text" name="userFName" placeholder="Full name">
          <input type="text" name="userEmail" placeholder="userEmail">
          <input type="text" name="userPhone" placeholder="Phone number">
          <input type="datetime-local" name="reserveTime" placeholder="Date and Time">
          <input type="number" name="numGuest" placeholder="# of Guests">
        </div>
        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </body>
</html>