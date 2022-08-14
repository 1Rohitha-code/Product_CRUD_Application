@extends('root.master_page')

@section('title')
Admin Dashboard
@endsection

@section('datatablestyle')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" > </script> 
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="//unpkg.com/feather-icons"></script>
@endsection

@section('navbar')

@include('admin.navbar')

@endsection


@section('content')

    <div class="row">
    <div class="col-md-10">
        <div class="pull-center">
            <div class="card" style="width:950px">
            <div class="card-header">
            <div class="text-center">
            <span style="font-size:26px">
            <div class="text-left">
            <a href="/product_list" class="btn btn-secondary">Back</a>
            </div>
            <b>Products</b>
            </span>
            <div class="text-right">
            <a href="/create_form" class="btn btn-primary btn-sm">Create new product</a>
            </div>
        </div>
  </div>
  <div class="card-body">
     <!--DELETE MODAL-->
        <div class="modal fade" id="prod_del_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deleting Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="delete_prod_modal_form" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                <div class="modal-body">
                    <div class="text-center">

                <p style="font-size:25px">Are you sure? </p> <p style="font-size:15px">Once deleted, you will not be able to recover this data!</p>
                        <input type="hidden" id="id">
            </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-sm" >Yes.Delete it.</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        <!--DELETE MODAL-->

                @if (session('status'))
                <div class="text-center">
                <h4><div class="alert alert-success" role="alert">
                      {{ session('status') }}
                </div></h4>
                </div>
                @endif 
  <table id="prod_details" class="display table-striped table table-bordered border-primary">
                    <thead>
                        <tr>
            <th class="num" style="width:30px">ID</th>
            <th>Prod cat id</th>
            <th>Name</th>
            <th>Title</th>
            <th>Class</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
            <th style="width:100px">Variants</th>
            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($prod_details as $data) 
                    <tr>
                        <td>
                        {{$data->id}}
                        </td>
                        <td>
                        {{$data->prod_cat_id}}
                        </td>
                        <td>
                        {{$data->name}}
                        </td>
                        <td>
                        {{$data->title}}
                        </td>
                        <td>
                        {{$data->class}}
                        </td>
                        <td>
                        {{$data->price}}
                        </td>
                        <td>
                        <img src="{{asset('uploads/product_imgs/'.$data->image)}}" width="100" height="70" alt="Image">
                        </td>
                        <td>
                        {{$data->status}}
                        </td>
                        <td>
                        <div class="text-center">
                        <button  type="button" class="btn btn-primary detail-btn btn-sm" data-bs-toggle="modal" data-bs-target="#myModal" data-id="{{$data->id}}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                               </div> 
                                 <!--Variant Modal-->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <div class="text-center">
        <h2 class="modal-title" id="exampleModalLabel" style="color:black"><b>Variants</b></h2>
          </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 <!------------------------------------table area----------------------------------------->
                        <table class="table table-hover table-bordered" style="color:black;font-size:14px">
                        <thead>
                            
                        </thead>
                      
                        <tbody>
                            <tr>
                            <th style="width:180px">Title</th>
                            <td id="title"></td>
                            </tr>   
                            <tr>
                            <th style="width:180px">Available Stock</th>
                            <td id="available_stock"></td>
                            </tr>

                        </tbody>
                        </table>
 <!------------------------------------table area----------------------------------------->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <!--variant Modal-->
                        </td>
                        <td>
                        <a href="/edit_page/{{$data->id}}" class="btn btn-secondary btn-sm" ><i class="fas fa-edit" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger  deletebtn btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></a>         
                        </td>
                         @endforeach
                        </tr>     
                    </tbody>
                    
                </table>
                </div>
                </div>
        </div>
    </div>
</div>


    @endsection


    @section('datatablescripts')
   
<script>
    $(document).ready(function() {
    $('#prod_details').DataTable( {
      
    } );
} );
</script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script>
    @if (session('status'))
swal.fire({
  title: '{{session('status')}}',
  icon: 'error',
  button: "OK",
});
@endif
</script>


<!--DELETE MODAL SCRIPTS-->
<script>
    $(document).ready(function() {
      $('#prod_details').DataTable();
        $('#prod_details').on('click','.deletebtn',function(){
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#id').val(data[0]);
            $('#delete_prod_modal_form').attr('action','/delete_product/'+data[0]);
            $('#prod_del_modal').modal('show');

        });

  } );
   </script>
<!--DELETE MODAL SCRIPTS-->

<!--variant MODAL SCRIPTS-->
<script>
    $('#myModal').modal('hide');
    $(document).ready(function(){
        $('.detail-btn').click(function(){
            const id =$(this).attr('data-id');
            //console.log(id);
            $.ajax({
                url: '/get_variant_data/'+id,
                type:'GET',
                data: {
                   "id" :id 
                },
                success:function(data){ 
                   // console.log(data);
                   $('#title').html(data.title);
                    $('#available_stock').html(data.available_stock);
                }
            })
        });
    });
</script>
<!--variant MODAL SCRIPTS-->
@endsection
