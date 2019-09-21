@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                    <h3>List Role</h3>
                <div class="card">
                    @if(session('alert'))
                    <div class="alert alert-success">
                        {{session('alert')}}
                    </div>
                    @endif
                    <div class="card-header">
                        <span><a class="btn btn-success" href="admin/role/add">Add</a></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Permissions</th>
                                    <th>Default</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $r)
                                <tr>
                                    <td>{{$r->name}}</td>
                                    <td>{{$r->description}}</td>
                                    <td> {{ implode(', ',json_decode( $r->permissions)) }}</td>
                                    <td>{{$r->is_default==1?"True":"False"}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('roles.edit',$r->id)}}">Edit</a>
                                        <a class="btn btn-danger" href="admin/role/delete/{{$r->id}}">Delete</a>
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