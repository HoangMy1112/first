<?php
include "views/head.php";
?>
<div class="bg s2">
  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
      <?php var_dump($errors); ?>
    </div>
  <?php endif; ?>
<div class="layer2">
 <div class="rblock pt-5">
     <div class="create">
         <h3 class="text-center"><i class="fa fa-user" aria-hidden="true"></i> Create New Account</h3>
        <form action="<?= ROOT ?>users/create" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Choose a username...">
            </div>    
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control">
            </div> 
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
            </div> 
            <div class="form-group">
              <label for="password_confirm">Password Confirm</label>
              <input type="password" name="password_confirm" class="form-control">
            </div>  
            <div class="form-group">
              <label for="phonenumber">Phone Number</label>
              <input type="phone" name="phonenumber" class="form-control">
            </div> 
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-plus-square" aria-hidden="true"></i> Create Account</button>
    
            <div>
              <p class="text-center">Already have an account?<a href="<?= ROOT ?>login">Log in</a></p>
            </div>
        </form>     
   </div> <!-- end of col-md-6 -->
 </div>
</div>
</div>


<?php
include "views/footer.php";
?>