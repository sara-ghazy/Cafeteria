
$(document).ready(function (){

        $(".user").click(function (e){
            let id=$(this).attr('userId')
            $(`#user${id}`).toggle(500);
        })

    $(".order").click(function (e){
        let id=$(this).attr('orderId')
        if(!$('#order'+id).is(':empty') ) {
            $('#order'+id).toggle(500)
        }else {
            $.ajax({
                type:'GET',
                url:'/checks/ordersDetails',
                data:{id:id},
                datatype:'json',
                success:function (data){
                    let cartona=''
                    data=JSON.parse(data)
                    for (let i in data)
                    {
                        cartona+=`
                        <div class="card shadow me-2" style="width: 18rem;">
                          <div class="card-body">
                            <h4 class="card-title text-dark fw-bold fs-1">${data[i].name}</h4>
                            <p class="card-text fw-bold fs-1 text-warning">Price : ${data[i].price}</p>
                            <h4 class="fw-bold fs-1 text-info" >Quantity : ${data[i].quantity}</h4>
                          </div>
                        </div>`
                        $('#order'+id).html(cartona)
                    }
                }
            })
        }

    })



});


