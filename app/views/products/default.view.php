
<div class="container shadow p-5 bg-light ">

    <a href="products/add" class="btn  text-success mb-5 rounded-pill shadow fs-2">Add New Product</a>
    <table class="table fs-2 text-info table-hover">
        <thead>
        <tr>
            <th class="col">Product Name</th>
            <th class="col">Product Price</th>
            <th class="col">Product Image</th>
            <th class="col">Product Category</th>
            <th class="col">Options</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products as $product )
        {?>
            <tr>
                <td><?=$product->name?></td>
                <td><?=$product->price?></td>
                <td><img src="<?='data:image/jpeg;base64,'.base64_encode($product->imgUrl)?>" width="100" height="100"/></td>
                <td>
                    <?php
                    foreach ($categories as $category)
                    { ?>
                        <?=$product->catId==$category->id?$category->name:''?>
                     <?php }
                    ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="/products/edit/<?=$product->id?>">Edit</a>
                    <a class="btn btn-danger" href="/products/delete/<?=$product->id?>">Delete</a>
                </td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>