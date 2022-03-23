

<div class="container text-success fs-2 d-flex justify-content-center bg-light shadow   ">
<form method="POST"  enctype="multipart/form-data" class="w-50 mt-5">
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" value="<?=isset($old['name'])?$old['name']:$user->name?>" aria-describedby="emailHelp">
    <?php if(isset($errors['name']))
    { ?>
        <div class="alert alert-warning fs-5">* Name <?=$errors['name']?> Characters</div>
    <?php   }
    ?>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" value="<?= isset($old['email'])?$old['email']:$user->email;?>"  aria-describedby="emailHelp">
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
    <label for="room" class="form-label">Room No</label>
    <input type="number" class="form-control" name="room" min="0" value="<?= isset($old['room'])?$old['room']:$user->room;?>" aria-describedby="emailHelp">
      <?php if(isset($errors['room']))
      { ?>
          <div class="alert alert-warning fs-5">* Room Number <?=$errors['room']?> </div>
      <?php   }
      ?>
  </div>

  <div class="mb-3">
    <label for="e" class="form-label">Ext.</label>
    <input type="number" class="form-control" name="ext" min="0" value="<?= isset($old['ext'])?$old['ext']:$user->ext;?>" aria-describedby="emailHelp">
      <?php if(isset($errors['ext']))
      { ?>
          <div class="alert alert-warning fs-5">* Ext <?=$errors['ext']?> </div>
      <?php   }
      ?>
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-success" name="update" value="Update" >
  </div>
</form>
</div>