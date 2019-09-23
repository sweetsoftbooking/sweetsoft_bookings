@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Room</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Room</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        @if(session('alert'))
                        <div class="col-md-4 alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> {{session('alert')}}</h5>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Edit Room</h3>
                        </div>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                        @endforeach
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('rooms.edit',$room->id)}}" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$room->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Information</label>
                                    <input type="text" name="information" class="form-control" value="{{$room->information}}">
                                </div>
                                <div class="form-group">
                                    <label>Large</label>
                                    <input type="number" name="large" min="1" max="1000" class="form-control" value="{{$room->large}}">
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="status" value="0" id="defaultUnchecked"
                                        {{$room->status==0?'checked':''}}>
                                    <label class="custom-control-label" for="defaultUnchecked">Empty</label>
                                  </div> 
                                  <!-- Default checked -->
                                  <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="status" value="1" id="defaultChecked"
                                        {{$room->status==1?'checked':''}}> 
                                    <label class="custom-control-label" for="defaultChecked">Booked</label>
                                  </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-primary" href="{{route('rooms.list')}}">Go To List</a>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
