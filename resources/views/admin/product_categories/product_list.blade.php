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
<link href="css/app.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="assets/css/feather.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/feather-icons"></script>
@endsection
@section('navbar')

@include('admin.navbar')

@endsection

@section('content')

    <div class="row">
    <div class="col-md-10">
        <div class="pull-center">
            <!---------------------content------------------->
            <div class="card" style="width:950px">
        <div class="card-header">
        <div class="text-center">
            <span style="font-size:26px">
            <b>Product Categories</b>
            </span>
            <div class="text-right">
            <a href="/cat_data_insertion_form" class="btn btn-primary btn-sm">Create new product Category</a>
            </div>
        </div>
  </div>
  <div class="card-body">
  
                @if (session('status'))
                <div class="text-center">
                <h4><div class="alert alert-success" role="alert">
                      {{ session('status') }}
                </div></h4>
                </div>
                @endif 
  <table id="user_roles" class="display table-striped table table-bordered border-primary">
         <thead>
            <tr>
            <th class="num" style="width:30px">ID</th>
            <th>Name</th>
            <th>Status</th>
            <th style="width:100px">Related products</th>
            <th style="width:160px">Action</th>
             </tr>
          </thead>
                    <tbody>
                   @foreach($data as $val)
                        <tr>
                            <td>
                            {{$val->id}}
                            </td>
                           <td>
                           {{$val->name}}
                            </td>
                            <td>
                            {{$val->status}}
                            </td>
                            <td>
                            <a href="/single_prod_data/{{$val->id}}" class="btn btn-primary btn-sm"  >Go to products</a>   
                            </td>
                            <td>
                            </form>
                            <a href="/edit_cat_data_form/{{$val->id}}" class="btn btn-info btn-sm"  ><i class="fas fa-edit" aria-hidden="true"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger  deletebtn btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
        <!---------------------------------DELETE MODAL-------------------------------->
                <div class="modal fade" id="user_delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="delete_user_form" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <div class="modal-body">
                        <div class="text-center">
                        <p style="font-size:28px">Are you sure? </p> <p style="font-size:18px">Once deleted, you will not be able to recover this data!</p>
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
      <!---------------------------------DELETE MODAL-------------------------------->
                        </tr>
                @endforeach
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
    $('#user_roles').DataTable( {
      
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
      $('#user_roles').DataTable();
        $('#user_roles').on('click','.deletebtn',function(){
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#id').val(data[0]);
            $('#delete_user_form').attr('action','/delete_cat_data_form/'+data[0]);
            $('#user_delete_modal').modal('show');
        });

  } );
   </script>
<!--DELETE MODAL SCRIPTS-->

@endsection
