@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                    <h3>List User</h3>
                <div class="card">
                    @if(session('alert'))
                    <div class="alert alert-success">
                        {{session('alert')}}
                    </div>
                    @endif
                    <div class="card-header">
                        <span><a class="btn btn-success" href="admin/user/add">Add</a></span>
                    </div>
                    <!-- /.card-header -->
                    {!!$user->links()!!}
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                <tr>
                                    <td>{{$u->username}}</td>
                                    <td>{{$u->name}}</td>
                                    <td> {{$u->email}}</td>

                                <td>@if ($u->roles->count()) {{$u->roles->first()->name}} @endif</td>

                                    <td>
                                        <a class="btn btn-primary" href="admin/user/edit/{{$u->id}}">&ensp;Edit&ensp;</a><br>
                                        <a class="btn btn-danger" href="admin/user/delete/{{$u->id}}">Delete</a>
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