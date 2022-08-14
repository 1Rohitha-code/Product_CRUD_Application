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

            <div class="card" style="width:700px">
            <div class="card-header">
                    <div class="text-center">
                        <span style="font-size:26px">
                        <b>Insert New Product Category</b>
                        </span>
                    </div>
            </div>
            <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <h6>{{ $error }}</h6>
                    @endforeach
                </ul>
            </div>
            @endif

                @if (session('status'))
                <div class="text-center">
                <h4><div class="alert alert-success" role="alert">
                      {{ session('status') }}
                </div></h4>
                </div>
                @endif 
 <!-----------------------form content---------------------------->   
 <form  method="POST" action="/update_cat_data_form/<?php echo $id;?>" enctype="multipart/form-data">
            {{csrf_field()}}
           
            <div class="row">
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="inputPassword4" style="font-size:16px">Product Category</label>
                        <input type="text" name="name" value="<?php echo $get_prod_cat_data->name; ?>" class="form-control my-colorpicker1"  placeholder="Category name"> 
                    </div>
                        <div class="mb-3 col-md-12">
                        <label class="form-label" for="inputPassword4" style="font-size:16px">Status</label>
                        <select class="form-select" name="status"  id="status">
                        <option value="Available" {{($get_prod_cat_data->status === 'Available') ? 'Selected' : ''}}>Available</option>
                        <option value="Unavailable" {{($get_prod_cat_data->status === 'Unavailable') ? 'Selected' : ''}}>Unavailable</option>
                      </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                    <a href="/admin_dashboard" class="btn btn-secondary btn-block" >Back</a>
                    </div>
                        <div class="mb-3 col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </div>
            </div> 
<!---------------------card1----------------------------->

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
            $('#delete_user_form').attr('action','/delete_user/'+data[0]);
            $('#user_delete_modal').modal('show');
        });
  } );
   </script>
<!--DELETE MODAL SCRIPTS-->

@endsection
