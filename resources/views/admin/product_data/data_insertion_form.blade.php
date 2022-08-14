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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
            <b>Create a new Product profile</b>
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
 <form  method="POST" action="/save_form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputPassword4" style="font-size:16px">Product Category</label>
                        <select class="form-select" name="prod_cat_id" id="prod_cat_id">
                            <option selected disabled>Select</option>
                            @foreach($get_cat_data as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                      </select>
                    </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputPassword4" style="font-size:16px">Title</label>
                        <input type="text" name="title" class="form-control my-colorpicker1"  placeholder="title"> 
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputPassword4" style="font-size:16px">Class</label>
                        <input type="text" name="class" class="form-control my-colorpicker1"  placeholder="class">
                    </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputPassword4" style="font-size:16px">Price</label>
                        <input type="text" name="price" class="form-control my-colorpicker1"  placeholder="price"> 
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputPassword4" style="font-size:16px">Image</label>
                        <input type="file" name="image" class="form-control my-colorpicker1"  >
                    </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputPassword4" style="font-size:16px">Available Stock</label>
                        <input type="text" name="available_stock" value="" class="form-control my-colorpicker1"  >
                    </div>
                </div>
              
                <div class="row">
                    <div class="mb-3 col-md-6">
                    <a href="/product_list" class="btn btn-secondary btn-block" >Back</a>
                    </div>
                        <div class="mb-3 col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
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
            $('#delete_user_form').attr('action','/delete_user/'+data[0]);
            $('#user_delete_modal').modal('show');
        });
  } );
   </script>
<!--DELETE MODAL SCRIPTS-->

@endsection
