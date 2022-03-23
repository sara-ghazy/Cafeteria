
<div class="container text-success fs-2 d-flex justify-content-center bg-light shadow" style="min-height: 500px">
    <form method="post" enctype="multipart/form-data" class="w-50">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="<?=$product->name?>" class="form-control" name="name" id="name">
            <?php if(isset($errors['name']))
            { ?>
                <div class="alert alert-warning fs-5">* product Name Must Be <?=$errors['name']?></div>
            <?php   }
            ?>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" value="<?=isset($old['price'])?$old['price']:$product->price?>" class="form-control" name="price" id="price">
            <?php if(isset($errors['price']))
            { ?>
                <div class="alert alert-warning fs-5">* product price Must Be <?=$errors['price']?></div>
            <?php   }
            ?>
        </div>

        <div class="mb-3">
            <label for="catName" class="form-label">Select Category</label>
            <select class="form-select" name="catId" aria-label="Default select example">
                <option selected >Select Category</option>
                <?php
                foreach ($categories as $category)
                {?>
                    <option <?=$product->catId==$category->id?'selected':''?> value="<?=$category->id?>"><?=$category->name?></option>
                <?php }
                ?>
            </select>
            <?php if(isset($errors['catId']))
            { ?>
                <div class="alert alert-warning fs-5">* Category Name Must Be <?=$errors['catId']?></div>
            <?php   }
            ?>
        </div>
        <button type="submit" class="btn btn-primary mb-4">Submit</button>
    </form>
</div>

