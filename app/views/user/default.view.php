


<div class="container shadow p-5 bg-light " style="min-height:500px">
        <a href="/user/add" class="btn text-success mb-5 rounded-pill shadow fs-2">Add New User</a>
        <table class="table fs-2 text-info table-hover">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Room</th>
              <th scope="col">Img</th>
              <th scope="col">Ext</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
         <?php  foreach($this->data['users'] as $user) {?>
            <tr>
              <td><?=$user->name?></td>
              <td><?=$user->room?></td>
              <td>
                  <img src="<?='data:image/jpeg;base64,'.base64_encode($user->imgUrl)?>" width="100" height="100"/>
                </td>
              <td><?=$user->ext?></td>
               <td>
                   <a href="./user/edit/<?= $user->id;?>" type="button" class="btn btn-warning mx-2" >Edit</a>
                   <a href= "./user/delete/<?= $user->id;?>"  type="button" class="btn btn-danger" >Delete</a>
               </td>
            </tr>

            <?php } ?>

          </tbody>
        </table>

</div>

