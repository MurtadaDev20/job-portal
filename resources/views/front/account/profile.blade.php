@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4">
                    <form action="" method="post" id="userForm" name="userForm">
                        @csrf
                        <div class="card-body  p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Designation*</label>
                                <input type="text" name="designation" id="designation" placeholder="Designation" class="form-control" value="{{ $user->designation }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Mobile*</label>
                                <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            <form action="" method="POST" name="changePasswordForm" id="changePasswordForm">
                @csrf
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                            <p></p>
                        </div>
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')

<script type="text/javascript">
    $('#userForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url :"{{route('account.updateprofile')}}",
            type : 'put',
            dataType : 'json',
            data: $("#userForm").serializeArray(),
            success:function(response){
                if(response.status == true)
                {
                    $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                    
                    $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')

                    window.location.href ='{{ route("account.profile") }}';
                }
                else 
                    {
                        var error = response.errors;

                        if (error.name)
                        {
                            $("#name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(error.name)
                        }
                        else 
                            {
                                $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                        if (error.email)
                        {
                            $("#email").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(error.email)
                        }
                        else 
                            {
                                $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                    
                    }
            }
        });
    });



    
</script>

{{-- /////////////////// --}}

<script type="text/javascript">
    $('#changePasswordForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url :"{{route('account.updatePassword')}}",
            type : 'post',
            dataType : 'json',
            data: $("#changePasswordForm").serializeArray(),
            
            success:function(response){
                if(response.status == true)
                {
                    $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                    
                    $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')

                    window.location.href ='{{ route("account.profile") }}';
                }
                else 
                    {
                        var error = response.errors;

                        if (error.old_password)
                        {
                            $("#old_password").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(error.old_password)
                        }
                        else 
                            {
                                $("#old_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                        if (error.new_password)
                        {
                            $("#new_password").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(error.new_password)
                        }
                        else 
                            {
                                $("#new_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }
                        if (error.confirm_password)
                        {
                            $("#confirm_password").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(error.confirm_password)
                        }
                        else 
                            {
                                $("#confirm_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                    
                    }
            }
        });
    });



    
</script>
@endsection