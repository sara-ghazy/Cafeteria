<div class="container  bg-light shadow" style="min-height: 500px">
    <div class="container " >
        <h1 class="my-5">Orders</h1>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Order Date</th>
            <th> Name</th>
            <th>Room</th>
            <th>Ext</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php $c=0; $cost=0;
        foreach($orders as $order){
        ?>
        <tr class="table-dark box">
            <td><button class="btn btn-primary show" id="order<?=(string)$order->id;?>">Toggle</button></td>
            <td><?= $order->created_at;  ?></td>
            <td><?= $order->name;  ?></td>
            <td><?= $order->room;  ?></td>
            <td><?= $order->ext;  ?> </td>
            <td>
                <div class="form-group flex">
                    <form method="POST">
                        <div class="col-5">
                            <select class="form-control" name="st">
                                <option value="deliver" <?php if($order->status=="deliver") echo 'selected'?>  >Deliver</option>
                                <option value="processing" <?php if($order->status=="processing") echo 'selected'?> >Process</option>
                                <option value="done" <?php if($order->status=="done") echo 'selected'?> > Done</option>
                            </select>
                        </div>
            <td>
                <input type="hidden" name="id" value="<?= $order->id; ?>">
                <input type="submit"  class="btn btn-success" value="Save"/>
            </td>
            </form>
</div>
</td>

<tr class="product" id="prod<?=(string)$order->id;?>">
    <td colspan="7">
        <div class="row border">
            <?php foreach($orderdetails[$c] as $od){?>
                <div class="col-3">

                    <img src="<?='data:image/jpeg;base64,'.base64_encode($od->imgUrl)?>" width="100px" height="100px"/>
                    <h3> <?= $od->productname;?></h3>
                    <h6>Quantity:  <?= $od->quantity;?></h6>
                    <h6>Price:  <?= $od->totalprice; $cost+=$od->totalprice;?></h6>

                </div>
            <?php } ?>
            <h2 class="offset-9">Total : EGP<?= $cost; ?></h2>
        </div>

    </td>
</tr>

</tr>

<?php  $c++; $cost=0;} ?>



</tbody>
</table>

</div>

<script>
    $(".product").hide();

    $('.show').click(function()
    {
        $x=(this.id);
        $box=$x.substr(5,$x.length);
        $product="#prod"+$box;
        $($product).toggle();


    });
</script>



    