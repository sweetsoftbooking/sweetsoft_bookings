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
                                <input type="text" name="description" class="form-control" value="{{$role->description}}">
                                </div>

                                <div class="form-group">
                                    <label>Permissions</label>
                                </div>
                                
                               <div id="checkTree"></div>
                               

                                <div class="form-group">
                                    <br/><label>Default&emsp;</label>

                                <input type="radio" class="flat" name="is_default" value="1" {{$role->is_default==1?'checked':''}}><label>Yes&emsp;</label>

                                    <input type="radio" class="flat" name="is_default" value="0" {{$role->is_default==0?'checked':''}}><label>No</label>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                @if(session('alert'))
                                <div class="alert alert-success">
                                    {{session('alert')}}
                                </div>
                                @endif
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
    let permissions = JSON.parse('{!! $role->permissions !!}');
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
                "label": "Add",
                "name": "permissions[events][event.add]",
                "value": "event.add",
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
                "label": "Add",
                "name": "permissions[rooms][room.add]",
                "value": "room.add",
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
                "label": "Add",
                "name": "permissions[users][user.add]",
                "value": "user.add",
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
    
      checkbox.checked = permissions[nodes[p]["value"]];
      checkbox.name = nodes[p]["name"];
      checkbox.id = checkbox.value;
      checkbox.className = 'permission-box'

      li.appendChild(checkbox);

      label = document.createElement("label");
    //   label.htmlFor = checkbox.id;
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

    $('body').on('click', '.permission-box', function(e){
        const $this = $(this);
        // console.log($this)
        const is_parent = $this.closest('li').find('ul').length;
        console.log(is_parent)
        if(is_parent){
            
            $this.closest('li').find('input.permission-box').prop('checked', true);
        }
        const is_child = $this.closest('.permission-box').length;
    });
    //   checkbox.addEventListener("click",function(){        
       
    //    var li = this.parentNode;
       
      
    //    var ul = li.getElementsByTagName("ul")[0];
    //    var boxes = ul.getElementsByTagName("input");
       
       
    //    for(let i = 0; i < boxes.length; i++){
    //      if( boxes[i]["type"] == "checkbox" )
    //         boxes[i]["checked"] = this.checked;
    //    }
       
    //  });

    }
};

checkTree.init("checkTree",jsonObj);

</script>
@endsection

