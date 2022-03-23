
<div class="container p-5 bg-light shadow" style="min-height: 480px">
        <form method="post" class="w-75 mb-5 text-primary">
            <div class="row mb-4">
                <div class="col-lg-2 col-xm-12 mb-5">
                    <label for="dateFrom " class="form-label fs-4"> Date From</label>
                </div>
                <div class="col-lg-4 col-xm-12 mb-5">
                    <input type="date" id="dateFrom" value="<?=isset($old['dateFrom'])?$old['dateFrom']:''?>" name="dateFrom" required class="form-control">
                </div>
                <div class="col-lg-2 col-xm-12 mb-5">
                    <label for="dateFrom" class="form-label fs-4"> Date To</label>
                </div>
                <div class="col-lg-4 col-xm-12 mb-5">
                    <input type="date" id="dateTo" value="<?=isset($old['dateTo'])?$old['dateTo']:''?>" required  name="dateTo" class="form-control d-inline">
                </div>
                <div class="col-lg-2 col-xm-12">
                    <label for="dateFrom" class="form-label fs-4"> Select User</label>
                </div>
                <div class="col-lg-4 col-xm-12">
                    <select class="form-select" name="user" aria-label="Default select example">
                        <option value="all" selected>All</option>
                        <?php
                          foreach ($users as $user)
                          {?>
                              <option <?=isset($old['user'])&&$old['user']==$user->id?'selected':''?> value="<?=$user->id?>"><?=$user->name?></option>
                          <?php }
                        ?>
                    </select>
                </div>
            </div>
            <button  class="btn btn-lg btn-outline-info text-dark">Filter</button>
        </form>
        <div class="row fs-2 text-danger ">
        <div class="col-8 ">
            <h4>Name</h4>
        </div>
        <div class="col-4 border-start ">
            <h4 class="text-center">Total amount</h4>
        </div>
        <hr>
        <?php
        $i=0;
        foreach ($usersDetails as $userDetails =>$orders)
        {?>
            <button userId="<?=str_replace(' ','',$userDetails)?>"   class="btn text-info shadow btn-light round fs-2 text-start mb-3 col-8 user">
                <p class="d-inline" ><?=$userDetails?></p>
            </button>
            <div class="col-4 bg-light shadow round mb-4 text-center  ">
                <?=$totalPrices[$i]?>
            </div>
            <div class="test" id="user<?=str_replace(' ','',$userDetails)?>" style="display: none" >
                <div class="row ps-5">
                    <?php
                    foreach ($orders as $order ) { ?>
                        <button orderId="<?=$order['orderId']?>" class="btn text-primary shadow btn-light round fs-2 text-start mb-3 col-8 order ">
                            <?=$order['created_at']?>
                        </button>
                        <div class="col-4 bg-light shadow round mb-4 text-center">
                            <?=$order['totalPrice']?>
                        </div>

                        <div class="row mb-4"  id="order<?=$order['orderId']?>"></div>
                    <?php }
                    ?>
                </div>
            </div>
        <?php $i++; }
        ?>
    </div>
</div>