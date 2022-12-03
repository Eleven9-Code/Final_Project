<?php
    include_once 'header.php';
?>
<body>
       <form action="includes/login.inc.php" method="post">
        <div class="title">
          <i class="fas fa-pencil-alt"></i> 
          <h2>LOGIN</h2>
        </div>
        <div class="info">
          <input type="text" name="userEmail" placeholder="email">
          <input type="text" name="userPass" placeholder="pass">
        </div>
        <a href="SignUp.php">Have a Account? signup here</a>
        <button type="submit" name="submit">Submit</button>
      </form>
      
    </div>
  </body>
</html>