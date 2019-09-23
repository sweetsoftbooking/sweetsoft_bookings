@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                    <h3>List Event</h3>
                <div class="card">
                    @if(session('alert'))
                    <div class="alert alert-success">
                        {{session('alert')}}
                    </div>
                    @endif
                    <div class="card-header">
                        <span><a class="btn btn-success" href="{{route('events.create')}}">Add</a></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event as $e)
                                <tr>
                                    <td>{{$e->name}}</td>
                                    <td>{{$e->description}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('events.edit',$e->id)}}">Edit</a>
                                    <a class="btn btn-danger" href="{{route('events.delete',$e->id)}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
@endsection