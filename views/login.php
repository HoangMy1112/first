<?php
include "views/head.php";
opcache_reset();
?>
<div class="bg s1">
<div class="layer1">



<div class="container my-5 py-5">
  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
      <?php var_dump($errors); ?>
    </div>
  <?php endif; ?>

<div class="block pt-5">
 <h3 class="text-center">Login</h3>
 <div class="">
   <div class="register">
        <!-- <h3><i class="fa fa-user-circle" aria-hidden="true"></i></h3> -->
        <form action="<?= ROOT ?>users/login" method="post">
        <div class="form-group">
              <label for="username"></label>
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>    

            <div class="form-group">
              <label for="password"></label>
              <input type="password" name="password" class="form-control"  placeholder="Password">
            </div> 
            <?php //CSRF::outputToken(); ?>
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-book" aria-hidden="true"></i> Login</button>
            <div>
              <p class="text-center">Don't have an account?<a href="<?= ROOT ?>register">Sign Up</a></p>
            </div>
          </form>
          <?php 
          // var_dump($_SESSION) 
          ?>
   </div> <!-- end of col-md-6 -->
 </div>
 </div>
</div>
</div>
</div>


<?php
include "views/footer.php";
?>