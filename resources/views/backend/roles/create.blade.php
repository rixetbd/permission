@extends('backend.master')

@section('page_title', 'Role Create')

@section('custom_style')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row align-items-center justify-content-center" style="height:70vh;">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Role Create</h5>
                    <span>You can upload multiple Lead</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.roles.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label pt-0 required" for="name">Name</label>
                            <input class="form-control" id="name" name="name" type="input" required placeholder="Enter Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_script')

@endsection
