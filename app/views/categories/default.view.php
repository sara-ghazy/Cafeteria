
<div class="container bg-light shadow p-5 " style="min-height: 480px">
    <a href="/categories/add" class="btn  text-success mb-5 rounded-pill shadow fs-2">Add New Category</a>
    <table class=" fs-2 text-info table  table-hover">
        <thead>
        <tr>
            <th class="col-10">Category Name</th>
            <th class="col-2">Options</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($categories as $key )
        {?>
            <tr>
                <td><?=$key->name?></td>
                <td>
                    <a class="btn btn-warning" href="/categories/edit/<?=$key->id?>">Edit</a>
                    <a class="btn btn-danger" href="/categories/delete/<?=$key->id?>">Delete</a>
                </td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>
