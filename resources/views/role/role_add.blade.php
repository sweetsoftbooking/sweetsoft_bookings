@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
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
                        @if ($errors->any())
                        <div class="col-md-6 alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @foreach ($errors->all() as $error)
                            <h5><i class="icon fas fa-exclamation-triangle"></i> {{$error}}</h5>
                            <div></div>
                            @endforeach

                        </div>

                        @endif
                        @if(session('alert'))
                        <div class="col-md-4 alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> {{session('alert')}}</h5>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Create Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="admin/role/add" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Permissions</label>
                                </div>
                                <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">
                                    <!-- <div id="treeview_container" class="hummingbird-treeview"> -->
                                    <ul id="treeview" class="hummingbird-base">
                                            <li><i class="fa fa-plus"></i> <label> <input id="node-1" data-id="custom-1"
                                                type="checkbox">Roles</label>
                                        <ul>
                                            <li><label>
                                                    <input class="hummingbirdNoParent" id="node-1-1"
                                                        data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                        value="roles.view">
                                                    View</label>
                                            </li>
                                            <li><label>
                                                    <input class="hummingbirdNoParent" id="node-1-1"
                                                        data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                        value="roles.create">
                                                    Create</label>
                                            </li>
                                            <li><label>
                                                    <input class="hummingbirdNoParent" id="node-1-1"
                                                        data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                        value="roles.edit">
                                                    Edit</label>
                                            </li>
                                            <li><label>
                                                    <input class="hummingbirdNoParent" id="node-1-1"
                                                        data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                        value="roles.delete">
                                                    Delete</label>
                                            </li>
                                        </ul>
                                    </li>
                                        <li><i class="fa fa-plus"></i> <label> <input id="node-1" data-id="custom-1"
                                                    type="checkbox">Events</label>
                                            <ul>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.view">
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.create">
                                                        Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.edit">
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.delete">
                                                        Delete</label>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        <li><i class="fa fa-plus"></i> <label> <input id="node-1" data-id="custom-1"
                                                    type="checkbox">Rooms</label>
                                            <ul>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.view">
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.create">
                                                        Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.edit">
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.delete">
                                                        Delete</label>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><i class="fa fa-plus"></i> <label> <input id="node-1" data-id="custom-1"
                                                    type="checkbox">Bookings</label>
                                            <ul>
                                                    <li><label>
                                                            <input class="hummingbirdNoParent" id="node-1-1"
                                                                data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                                value="bookings.list">
                                                            View All</label>
                                                    </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.view">
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.create">
                                                        Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.edit">
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.delete">
                                                        Delete</label>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><i class="fa fa-plus"></i> <label> <input id="node-1" data-id="custom-1"
                                                    type="checkbox">Users</label>
                                            <ul>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.view">
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.create">
                                                        Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.edit">
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.delete">
                                                        Delete</label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <a style="color:white;" class="btn btn-primary" id="checkAll">Check All</a>
                                <a style="color:white;" class="btn btn-danger" id="uncheckAll">Uncheck All</a>
                                <a style="color:white;" class="btn btn-warning" id="collapseAll">Collapse All</a>

                                <div class="form-group">
                                    <br /><label>Default&emsp;</label>

                                    <input type="radio" class="flat" name="is_default"
                                        value="1"><label>Yes&emsp;</label>

                                    <input type="radio" class="flat" name="is_default" checked=""
                                        value="0"><label>No</label>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>&emsp;
                                <a class="btn btn-primary" href="admin/role">Go To List</a>
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

@section('script')
<script>
    $("#treeview").hummingbird();
$( "#checkAll" ).click(function() {
    $("#treeview").hummingbird("checkAll");
});
$( "#uncheckAll" ).click(function() {
  $("#treeview").hummingbird("uncheckAll");
});
$( "#collapseAll" ).click(function() {
  $("#treeview").hummingbird("collapseAll");
});
</script>

@endsection