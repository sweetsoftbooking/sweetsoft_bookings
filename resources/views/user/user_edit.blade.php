@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
            <form data-parsley-validate class="form-horizontal form-label-left" action="admin/user/edit/{{$user->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="sign-up">
                            @if(count($errors)>0)
                            <div class="alert alert-danger">
                              @foreach($errors->all() as $err)
                              {{$err}} <br>
                              @endforeach
                            </div>
                            @endif
                            @if(session('alert'))
                            <div class="alert alert-success">
                                {{session('alert')}}
                            </div>
                            @endif
                        <h3 style="color:green; fontWeight:bold">Add User</h3><br>
                        <h5>Personal Information</h5>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Name <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Email <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Age <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="age" class="form-control" value="{{$user->age}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Phone <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Address <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="address" class="form-control" value="{{$user->address}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Information <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="information" class="form-control" value="{{$user->information}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Department <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="department" class="form-control" value="{{$user->department}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Position <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="position" class="form-control" value="{{$user->position}}"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Role
                                </label>
                                <div class="x-content">
                                    <select name="role">
                                        @foreach($role as $r)
                                        
                                        <option value="{{$r->id}}" 
                                            @if (in_array($r->id,$selected))
                                            selected="selected"
                                        @endif >{{$r->name}}</option>
                                        
                                        @endforeach 
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <br /><label>Super Admin&emsp;</label>

                            <input type="radio" class="flat" name="is_super"
                                value="1" {{$user->is_super==1?'checked':''}}
                                ><label>Yes&emsp;</label>

                            <input type="radio" class="flat" name="is_super"
                                value="0" {{$user->is_super==0?'checked':''}}
                                ><label>No</label>
                        </div>
                        <h5>Login Information</h5>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Username <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Password <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Confirm Password <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="password" name="confirmation" id="confirm_password" class="form-control">
                                    <span id='message'></span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-success">Submit</button>&emsp;
                            <a class="btn btn-primary" href="admin/user">Go To List</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection