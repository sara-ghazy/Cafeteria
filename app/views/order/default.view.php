
<style>
    body
    {
        background-color:#f7f3ec;
        
    }

</style>

<!------Search----->

<div class="container mt-5">
    <form method="POST">
        <label>From:</label>
        <input type="date" name="from" class="mx-2" value='<?=$from;?>'/>
        <label>To:</label>
        <input type="date" name="to" value='<?=$to;?>'/>
        <input type="submit" name="search"  value="Search" class="mx-2 btn btn-warning" />
   </form>
</div>



<!-----------My Order-------------->

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-3 h3">Order Date</div>
            <div class="col-3 h3">Status</div>
            <div class="col-3 h3">Amount</div>
            <div class="col-3 h3">Action</div>
        </div>

        <div class="accordion" id="accordionExample">
            <?php $c=0; $cost=0; foreach($order as $ord){ ?>
            <div class="accordion-item">
              <h6 class="accordion-header" id="heading<?=$ord->id?>">
                  <div class="row text-center">
                      <div class="col-3">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$ord->id?>" aria-expanded="true" aria-controls="collapse<?=$ord->id?>">
                          <?= $ord->created_at;?>
                          </button>
                      </div>
                      <div class="col-3">
                      <?= $ord->status;?>
                      </div>
                      <div class="col-3">
                      <?= $ord->totalPrice;?>
                      </div>
                      <div class="col-3">
                          <form method="POST" action="/order/default/?orderid=<?=$ord->id;?>">
                         <input type="submit" name="cancel" class="btn btn-success " value="Cancel" <?php if($ord->status!="processing") echo "disabled" ?>>
                         </form>
                      </div>
                  </div>
              </h6>
              <div id="collapse<?=$ord->id?>" class="accordion-collapse collapse show" aria-labelledby="heading<?=$ord->id?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row">
                        <?php foreach($orderdetails[$c] as $od) {?>
                        <div class="col-3">
                        <img src="<?='data:image/jpeg;base64,'.base64_encode($od->imgUrl)?>"  class="img-fluid" height="100px" width="100px" />
                          
                            <h3> <?= $od->productname;?></h3>
                           <h6>Quantity:  <?= $od->quantity;?></h6>
                           <h6>Price:  <?= $od->totalprice; $cost+=$od->totalprice;?></h6>
                        </div>
                        <?php  } ?>
                       

                    </div>
                
                </div>
              </div>
            </div>

            <?php $c++;} ?>
            <h2 class="offset-9">Total : EGP<?= $cost; ?></h2>

          </div>


        </div>

                     

