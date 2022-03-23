
<div class="container text-success fs-2 d-flex justify-content-center bg-light shadow">


<form method="POST" enctype="multipart/form-data" class="w-50 mt-5">
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" value="<?=isset($old['name'])?$old['name']:''?>" class="form-control" name="name"  aria-describedby="emailHelp">
    <?php if(isset($errors['name']))
    { ?>
        <div class="alert alert-warning fs-5">* Name <?=$errors['name']?></div>
    <?php   }
    ?>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" value="<?=isset($old['email'])?$old['email']:''?>" class="form-control" name="email" aria-describedby="emailHelp">
    <?php if(isset($errors['email']))
    { ?>
        <div class="alert alert-warning fs-5">* Email <?=$errors['email']?> </div>
    <?php   }
    ?>
    <?php if(isset($error_email))
    { ?>
        <div class="alert alert-warning fs-5"><?=$error_email?> </div>
    <?php   }
    ?>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" value="<?=isset($old['password'])?$old['password']:''?>" class="form-control" name="password"  aria-describedby="emailHelp">
      <?php if(isset($errors['password']))
      { ?>
          <div class="alert alert-warning fs-5">* Password <?=$errors['password']?> </div>
      <?php   }
      ?>
  </div>

  <div class="mb-3">
    <label for="confirmpassword" class="form-label">Confirm Password</label>
    <input type="password" value="<?=isset($old['confirm_password'])?$old['confirm_password']:''?>" class="form-control" name="confirm_password" aria-describedby="emailHelp">
      <?php if(isset($errors['confirm_password']))
      { ?>
          <div class="alert alert-warning fs-5">*confirm Password <?=$errors['confirm_password']?> </div>
      <?php   }
      ?>
  </div>


  <div class="mb-3">
    <label for="room" class="form-label">Room No</label>
    <input type="number" value="<?=isset($old['room'])?$old['room']:''?>" class="form-control" name="room" min="0" aria-describedby="emailHelp">
      <?php if(isset($errors['room']))
      { ?>
          <div class="alert alert-warning fs-5">* room number <?=$errors['room']?> </div>
      <?php   }
      ?>
  </div>


  <div class="mb-3">
    <label for="ext" class="form-label">Ext.</label>
    <input type="number" value="<?=isset($old['ext'])?$old['ext']:''?>" class="form-control" name="ext" min="0" aria-describedby="emailHelp">
      <?php if(isset($errors['ext']))
      { ?>
          <div class="alert alert-warning fs-5">* Ext <?=$errors['ext']?> </div>
      <?php   }
      ?>
  </div>


  <div class="mb-3">
    <label for="imgUrl" class="form-label">Profile Picture</label>
    <input type="file" class="form-control" name="imgUrl" aria-describedby="emailHelp">
      <?php if(isset($image))
      { ?>
          <div class="alert alert-warning fs-5">* image <?=$image?> </div>
      <?php   }
      ?>
  </div>


  <div class="mb-3">
    <input type="submit" class="btn btn-success" type="button" name="add" value="Add" >
  </div>

</form>

</div>

