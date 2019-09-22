@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content">
            <br><h3 style="color:green; fontWeight:bold">Add User</h3><br>
        <div class="row justify-content-center">
            <div class="col-8">
                <form data-parsley-validate class="form-horizontal form-label-left" action="admin/user/add" method="POST">
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
                        
                        <h5 style="font-weight: bold; color:lightseagreen;">Personal Information</h5>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Name <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="name" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Email <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="email" name="email" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Phone
                                </label>
                                <div class="x-content">
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Address
                                </label>
                                <div class="x-content">
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Information
                                </label>
                                <div class="x-content">
                                    <input type="text" name="information" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Department
                                </label>
                                <div class="x-content">
                                    <input type="text" name="department" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Position
                                </label>
                                <div class="x-content">
                                    <input type="text" name="position" class="form-control">
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
                                        
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <br /><label>Super Admin&emsp;</label>

                                <input type="radio" class="flat" name="is_super"
                                    value="1"><label>Yes&emsp;</label>

                                <input type="radio" class="flat" name="is_super" checked=""
                                    value="0"><label>No</label>

                            </div>
                        <h5 style="font-weight: bold; color:lightseagreen;">Login Information</h5>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Username <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="text" name="username" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Password <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="password" name="password" id="password" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="x-title" for="first-name">Confirm Password <span class="required">*</span>
                                </label>
                                <div class="x-content">
                                    <input type="password" name="confirm" id="confirm_password" class="form-control">
                                    <span id='message'></span>
                                </div>
                            </div>
                        </div>
                        
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

@section('script')
<script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else 
                $('#message').html('Not Matching').css('color', 'red');
        });
    </script>
@endsection