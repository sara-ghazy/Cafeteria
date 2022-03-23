

<div class="container text-success fs-2 d-flex justify-content-center bg-light shadow" style="min-height: 500px">

    <form method="post" enctype="multipart/form-data" class="w-50 mb-5">
        <div class="mb-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" value="<?=isset($old['name'])?$old['name']:''?>" name="name" id="name">
            <?php if(isset($errors['name']))
            { ?>
                <div class="alert alert-warning fs-5">* product Name <?=$errors['name']?> Characters</div>
            <?php   }
            ?>
        </div>
        <div class="mb-4">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" value="<?=isset($old['price'])?$old['price']:''?>" name="price" id="price">
            <?php if(isset($errors['price']))
            { ?>
                <div class="alert alert-warning fs-5">* Product price Must Be <?=$errors['price']?></div>
            <?php   }
            ?>
        </div>
        <div class="mb-4">
            <label for="imgUrl" class="form-label">Image</label>
            <input type="file" class="form-control" name="imgUrl" id="imgUrl">
            <?php if(isset($image))
            { ?>
                <div class="alert alert-warning fs-5">* <?=$image?></div>
            <?php   }
            ?>
        </div>
        <div class="mb-4">
            <label for="catName" class="form-label">Select Category</label>
            <select class="form-select" name="catId" aria-label="Default select example">
                <option selected  value="all">Select Category</option>
                <?php
                    foreach ($categories as $category)
                    {?>
                       <option <?=isset($old['catId'])&&$category->id==$old['catId']?'selected':''?> value="<?=$category->id?>"><?=$category->name?></option>
                    <?php }
                ?>
            </select>
            <?php if(isset($errors['catId']))
            { ?>
                <div class="alert alert-warning fs-5">* Category Name <?=$errors['catId']?></div>
            <?php   }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
