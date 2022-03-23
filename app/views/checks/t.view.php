

<div class="container mt-5" style="min-height: 480px">
    <div class="row fs-2 text-danger ">
        <div class="col-8 ">
            <h4>Name</h4>

        </div>
        <div class="col-4 border-start ">
            <h4 class="text-center">Total amount</h4>
        </div>
        <hr>
        <?php
        foreach ($users as $user)
        {?>
            <button userId="<?=$user['id']?>"   class="btn text-info shadow btn-light round fs-2 text-start mb-3 col-8 userOpen">
                <p class="d-inline" ><?=$user['name']?></p>
            </button>
            <div class="col-4 bg-light shadow round mb-4 text-center  ">
                <?=$user['totalPrice']?>
            </div>
<!--            <hr>-->
            <div class="" id="user<?=$user['id']?>" ></div>
        <?php }
        ?>
    </div>
</div>
