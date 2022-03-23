<div class="container text-info fs-2 d-flex justify-content-center bg-light shadow " style="min-height: 500px">
    <form method="post" class="w-50 mt-5">
        <div class="mb-3">
            <label for="catName" class="form-label">Category Name</label>
            <input type="text" value="<?=isset($old['catName'])?$old['catName']:$cat->name ?>" class="form-control" name="catName" id="catName">
            <?php if(isset($errors['catName']))
            { ?>
                <div class="alert alert-warning fs-5">Category Name Must Be <?=$errors['catName']?></div>
            <?php   }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
