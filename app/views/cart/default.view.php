
<div class="container shadow p-5 bg-light mt-3 " style="min-height:500px">
<!--------------start latest order------------------>

<div class="layout text-light" id="latestorder" style="display:none;" >
    <button class="offset-11 mt-4 hideorder">X</button>
    <?php if(!empty($this->data['latestorder'])){ ?>
    <h2 class="m-4"><?= $dateoflastorder;?></h2>
    <div class="container">
        <table class="table text-light">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Img</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>

                <?php for($lproducts=0;$lproducts<count($latestorder);$lproducts++){?>
                <tr>
                    <td><?= $latestorder[$lproducts]->productname;?></td>

                    <td><?='<img src="data:image/jpeg;base64,'.base64_encode($latestorder[$lproducts]->imgUrl).'" width="40" height="40" />' ?></td>
                    <td><?= $latestorder[$lproducts]->quantity;?></td>
                    <td><?= $latestorder[$lproducts]->totalprice;?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <?php } ?>

</div>

<!----------end latest order------------------->





<div class="container">
    <div class="row">

        <div class="col-4 mt-4">

            <form method="POST">
                <input type="text" name="searchProduct" value="<?=isset($search)?$search:'';?>">
                <input type="submit" name="search" value="Search" class="btn-warning">
            </form>

        </div>


        <div class="col offset-6 mt-4">
            
      <button   class="btn btn-primary" id="showorder">Latest Order</button>
            
        </div>
    </div>

</div>



<div class="row">
    <div class="col-7">
        <div class="row container mt-5">
            <?php  foreach($products as $product) {?>
            <div class="col ">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded border-3 text-center" style="width: 18rem;">
                    <form method="POST" action="/cart/default/?id=<?=$product->id?>">
                        <img src="<?='data:image/jpeg;base64,'.base64_encode($product->imgUrl)?>" name="imgUrl" class="card-img-top" style="height: 7rem;" alt="..."/>
                        <div class="card-body">
                            <input type="hidden" name="price" value="<?= $product->price;?>" />
                            <input type="hidden" name="name" value="<?= $product->name;?>" />
                            <h5 class="card-title"><?= $product->name;?></h5>
                            <p class="card-text"><?=$product->price;?></p>
                            <input type="number" class=" w-50 mb-3" name="quantity" min="1" value="1">
                            <input type="submit" class="btn btn-success" name="add" value="Add To Cart">
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="col mt-5">
    <div class="container">
        <div class=" shadow-lg p-2 mb-2 bg-white rounded border-3">
            <fieldset>
                <legend>My Cart</legend>
            </fieldset>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">TotalPrice</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
      $cost=0;
      if(!empty($_SESSION['cart'])){
        $cart=$_SESSION['cart'];
       ; $r=1; foreach($cart as  $c) {?>
                    <tr>
                        <th scope="row"><?= $r;?></th>
                        <td><?= $c['name'];?></td>
                        <td><?= $c['quantity'];?></td>
                        <td><?= $c['price']*$c['quantity']; $cost+=$c['price']*$c['quantity'];?></td>
                        <td>
                            <form method="POST" action="/cart/default/?id=<?=$c['id']?>">
                                <input type="submit" name="cancel" class="btn btn-danger" value="Cancel">
                            </form>
                        </td>
                    </tr>

                    <?php $r++; } }?>

                    <tr>
                        <td colspan="5">
                            <h2 class="offset-5">Total Price: <?= $cost; $_SESSION['totalprice']=$cost;?> EGY</h2>
                            <form method="POST">
                                <input type="submit" <?= ($cost>0)?'':'disabled'?> name="confirm"
                                    class="btn btn-success offset-1" value="Confirm" />
                            </form>
                        </td>

                    <tr>

                </tbody>

            </table>


        </div>
    </div>



</div>


</div>

       </div>