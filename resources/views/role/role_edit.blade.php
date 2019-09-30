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
                        @if(session('alert'))
                        <div class="col-md-4 alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> {{session('alert')}}</h5>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Edit Role</h3>
                        </div>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                        @endforeach
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="admin/role/edit/{{$role->id}}" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$role->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control"
                                        value="{{$role->description}}">
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
                                                            value="roles.view"
                                                            {{in_array("roles.view",$permissions)?"checked":""}}>
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="roles.create"
                                                            {{in_array("roles.create",$permissions)?"checked":""}}>Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="roles.edit"
                                                            {{in_array("roles.edit",$permissions)?"checked":""}}>
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="roles.delete"
                                                            {{in_array("roles.delete",$permissions)?"checked":""}}>
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
                                                            value="events.view"
                                                            {{in_array("events.view",$permissions)?"checked":""}}>
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.create"
                                                            {{in_array("events.create",$permissions)?"checked":""}}>Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.edit"
                                                            {{in_array("events.edit",$permissions)?"checked":""}}>
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="events.delete"
                                                            {{in_array("events.delete",$permissions)?"checked":""}}>
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
                                                            value="rooms.view"
                                                            {{in_array("rooms.view",$permissions)?"checked":""}}>
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.create"
                                                            {{in_array("rooms.create",$permissions)?"checked":""}}>Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.edit"
                                                            {{in_array("rooms.edit",$permissions)?"checked":""}}>
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="rooms.delete"
                                                            {{in_array("rooms.delete",$permissions)?"checked":""}}>
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
                                                            value="users.view"
                                                            {{in_array("users.view",$permissions)?"checked":""}}>
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.create"
                                                            {{in_array("users.create",$permissions)?"checked":""}}>Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.edit"
                                                            {{in_array("users.edit",$permissions)?"checked":""}}>
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="users.delete"
                                                            {{in_array("users.delete",$permissions)?"checked":""}}>
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
                                                                value="bookings.list" 
                                                                {{in_array("bookings.list",$permissions)?"checked":""}}>
                                                            View All</label>
                                                    </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.view"
                                                            {{in_array("bookings.view",$permissions)?"checked":""}}>
                                                        View</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.create"
                                                            {{in_array("bookings.create",$permissions)?"checked":""}}>Create</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.edit"
                                                            {{in_array("bookings.edit",$permissions)?"checked":""}}>
                                                        Edit</label>
                                                </li>
                                                <li><label>
                                                        <input class="hummingbirdNoParent" id="node-1-1"
                                                            data-id="custom-1-1" type="checkbox" name="permissions[]"
                                                            value="bookings.delete"
                                                            {{in_array("bookings.delete",$permissions)?"checked":""}}>
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

                                    <input type="radio" class="flat" name="is_default" value="1"
                                        {{$role->is_default==1?'checked':''}}><label>Yes&emsp;</label>

                                    <input type="radio" class="flat" name="is_default" value="0"
                                        {{$role->is_default==0?'checked':''}}><label>No</label>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>

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

{{-- <script>
        let jsonObj = {
  "nodes": {

    "91":{
        "flag": false,
        "label": "Managing Event",
        "name": 'permissions[events][event.general]',
        "value": "event.general",
        "nodes": {
            "1":{
                "flag": false,
                "label": 'View',
                "name": "permissions[events][event.view]",
                "value": "event.view"
            },
            "2":{
                "flag": false,
                "label": "Create",
                "name": "permissions[events][event.create]",
                "value": "event.create",
            },
            "3":{
                "flag": false,
                "label": "Edit",
                "name": "permissions[events][event.edit]",
                "value": "event.edit"
            },
            "4":{
                "flag": false,
                "label": "Delete",
                "name": "permissions[events][event.delete]",
                "value": "event.delete",
            }
        }
    },
    "92":{
        "flag": false,
        "label": "Managing Room",
        "name": 'permissions[rooms][room.general]',
        "value": "room.general",
        "nodes": {
            "5":{
                "flag": false,
                "label": 'View',
                "name": "permissions[rooms][room.view]",
                "value": "room.view"
            },
            "6":{
                "flag": false,
                "label": "Create",
                "name": "permissions[rooms][room.create]",
                "value": "room.create",
            },
            "7":{
                "flag": false,
                "label": "Edit",
                "name": "permissions[rooms][room.edit]",
                "value": "room.edit"
            },
            "8":{
                "flag": false,
                "label": "Delete",
                "name": "permissions[rooms][room.delete]",
                "value": "room.delete",
            }
        }
    },
    "93":{
        "flag": false,
        "label": "Managing User",
        "name": 'permissions[users][user.general]',
        "value": "user.general",
        "nodes": {
            "9":{
                "flag": false,
                "label": 'View',
                "name": "permissions[users][user.view]",
                "value": "user.view"
            },
            "10":{
                "flag": false,
                "label": "Create",
                "name": "permissions[users][user.create]",
                "value": "user.create",
            },
            "11":{
                "flag": false,
                "label": "Edit",
                "name": "permissions[users][user.edit]",
                "value": "user.edit"
            },
            "12":{
                "flag": false,
                "label": "Delete",
                "name": "permissions[users][user.delete]",
                "value": "user.delete",
            }
        }
    },
    "94":{
        "flag": false,
        "label": "Managing Event",
        "name": 'permissions[bookings][booking.general]',
        "value": "booking.general",
        "nodes": {
            "13":{
                "flag": false,
                "label": 'View',
                "name": "permissions[bookings][booking.view]",
                "value": "booking.view"
            },
            "14":{
                "flag": false,
                "label": "Edit",
                "name": "permissions[bookings][booking.edit]",
                "value": "booking.edit"
            },
            "15":{
                "flag": false,
                "label": "Delete",
                "name": "permissions[bookings][booking.delete]",
                "value": "booking.delete",
            }
        }
    }

  }
};

var checkTree = {
    mounting: function(currentElement, nodes){
    var ul, li, checkbox, label, span;
    ul = document.createElement("ul"); 
    
    for(let p in nodes){
      li = document.createElement("li");  

      checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      
      
      checkbox.checked = nodes[p]["flag"];
      checkbox.name = nodes[p]["name"];
      checkbox.id = checkbox.value;
      checkbox.createEventListener("click",function(){        
       
        var li = this.parentNode;
        
       
        var ul = li.getElementsByTagName("ul")[0];
        var boxes = ul.getElementsByTagName("input");
        
        
        for(let i = 0; i < boxes.length; i++){
          if( boxes[i]["type"] == "checkbox" )
             boxes[i]["checked"] = this.checked;
        }
        
      });
      

      
      li.appendChild(checkbox);

      label = document.createElement("label");
      label.htmlFor = checkbox.id;
      label.innerHTML = nodes[p]["label"];

      li.appendChild(label);

      if(nodes[p]["nodes"]){
        span = document.createElement("span");
        span.className = "checkTree-open";
        span.onclick = function(){
          let triangle = this.className.indexOf("checkTree-open")+1;   
          this.className = triangle ? "checkTree-close":"checkTree-open";
          let ul = this.parentNode.getElementsByTagName("ul")[0];
          ul.style.display = triangle ? "none" : "block";
        }
        li.insertBefore(span, li.firstChild);
        this.mounting(li ,nodes[p]["nodes"])
      }
      
      ul.appendChild(li);
    }

    currentElement.appendChild(ul);
    },
    init: function(id, jsonObj){
      var t = document.getElementById(id);
      this.mounting(t, jsonObj.nodes);    
    }
};

checkTree.init("checkTree",jsonObj);
    </script>
     --}}