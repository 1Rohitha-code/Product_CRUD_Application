@extends('root.master_page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 style="color:red">You are not allowed to visit this route</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
