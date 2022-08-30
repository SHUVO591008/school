
@extends('layouts.app')


@section('web')


<!--gallery-->
<div id="profile" style="min-height:0;" class=" profile">

    <div class="profile-bottom">
    <h3><i class="fa fa-user"></i>Profile</h3>
    <div class="profile-bottom-top">
    <div class="col-md-4 profile-bottom-img">
        
        <img style="width: 100%" src="{{(!empty($user->image))?url($user->image):url('profile/avatar.png') }}" alt="profile-image">
    </div>
    <div class="col-md-8 profile-text">
        <h6>{{ $user->name }}</h6>
        <table>
        <tr><td>Department</td>  
        <td>:</td>  
        <td>{{ $user->usertype }}</td></tr>
        
        <tr>
        <td>Email</td>
        <td> :</td>
        <td><a href="{{ $user->email }}">{{ $user->email }}</a></td>
        </tr>
        <tr>
        <td>Mobile</td>
        <td> :</td>
        <td> 
        @if ($user->mobile==null)
            <p class="text-muted">N/A</p>
       @else
           <p>{{ $user->mobile }}</p>
       @endif
        </td>
        </tr>
        <tr>
        <td>Address </td>
        <td>:</td>
        <td> 
        @if ($user->address==null)
            <p class="text-muted">N/A</p>
       @else
           <p>{{ $user->address }}</p>
       @endif
        </td>

        <tr>
            <td>Gender </td>
            <td>:</td>
            <td> 
            @if ($user->gender==null)
                <p class="text-muted">N/A</p>
           @else
               <p>{{ $user->gender }}</p>
           @endif
        </td>
        </tr>
        </table>
    </div>
    <div class="clearfix"></div>
    </div>
    <div class="profile-bottom-bottom">
    <div class="col-md-4 profile-fo">
        <h4>23,5k</h4>
        <p>Followers</p>
        <a href="#" class="pro"><i class="fa fa-plus-circle"></i>Follow</a>
    </div>
    <div class="col-md-4 profile-fo">
        <h4>348</h4>
        <p>Following</p>
        <a href="#" class="pro1"><i class="fa fa-user"></i>View Profile</a>
    </div>
    <div class="col-md-4 profile-fo">
        <h4>23,5k</h4>
        <p>Snippets</p>
        <a href="#"><i class="fa fa-cog"></i>Options</a>
    </div>
    <div class="clearfix"></div>
    </div>
    <div class="profile-btn">

        <button id="edit_btn" type="button" class="btn bg-red">Edit Profile</button>
   <div class="clearfix"></div>
    </div>
     
    
    </div>
</div>
<!--//gallery-->


<!--Edit-->

<div id="profile_show" style="display: none" class="profile">
    <form id="myForm" action="{{ route('profile.update',$user->id) }}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
        <div class="profile-bottom">
            <h3><i class="fa fa-user"></i>Edit Profile</h3>
            <div class="profile-bottom-top">
            <div class="col-md-4 profile-bottom-img">
                
                <img style="width: 100%" src="{{(!empty($user->image))?url($user->image):url('profile/avatar.png') }}" alt="profile-image">
            </div>
            <div class="col-md-8 profile-text">
                <h6>{{ $user->name }}</h6>
                <table>
                <tr><td>Name</td>  
                <td>:</td>
                <td>
                    <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" id="FullName" class="form-control" required>
                    <span id="name" style="color: red"></span>
                    @error('name')
                        <span style="color: red" class="invalid-feedback error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                </tr>  
                <tr><td>Email</td>  
                <td>:</td>  
                <td>
                    <input type="email" name="email" value="{{ $user->email }}" placeholder="Email" id="Email" class="form-control" required>
                    @error('email')
                        <span class="invalid-feedback error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                </tr>
                
                <tr>
                <td>Mobile</td>
                <td> :</td>
                <td>
                    <input type="text" name="mobile" value="{{ $user->mobile }}" placeholder="Mobile" id="Username" class="form-control" required>

                    @error('mobile')
                        <span class="invalid-feedback error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                </tr>
                <tr>
                <td>Address</td>
                <td> :</td>
                <td> 
                    <input type="text" name="address" value="{{ $user->address }}" placeholder="Address" id="address" class="form-control" required>

                    @error('address')
                        <span class="invalid-feedback error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                </tr>

                <tr>
                <td>Gender </td>
                <td>:</td>
                <td> 
                    <select name="gender" id="user-type" class="form-control"  required>
                        <option hidden value="">Select Gender</option>
                        <option value="Male" {{ ($user->gender=='Male')?"selected":"" }}>Male</option>
                        <option value="Female" {{ ($user->gender=='Female')?"selected":"" }}>Female</option> 
                    </select>

                @error('gender')
                    <span class="invalid-feedback error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </td>
                </tr>

                <tr>
                    <td>Image </td>
                    <td>:</td>
                    <td> 
                        <input accept="image/*" type="file" class="form-control @error('image') is-invalid @enderror upload" name="image" onchange="readURL(this);">

                        <img id="image" src="#" />

                        @error('image')
                            <span class="invalid-feedback error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="hidden" name="old_photo" value="{{$user->image}}">
                    </td>
                </tr>

                </table>
            </div>
            <div class="clearfix"></div>
            </div>
        
            <div class="profile-btn">
                
                <button type="submit" class="btn bg-red">Update Profile</button>

                <button id="show_profile" style="float: left" class="btn bg-success">Back</button>
            
        <div class="clearfix"></div>
            </div>
                
        </div>
    </form>
</div>

<!--//Edit-->




{{-- image show --}}
<script type="text/javascript">

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                .attr('src',e.target.result)
                .width(80)
                .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{-- edit profile show --}}
<script type="text/javascript">
    $(document).on('click','#edit_btn',function(){
        $('#profile_show').show();
        $('#profile').hide();
    });
</script>

{{-- show profile show --}}
<script type="text/javascript">
    $(document).on('click','#show_profile',function(){
        $('#profile').show();
        $('#profile_show').hide();
    });
</script>


   {{-- Validation Form --}}
{{-- <script type="text/javascript">
         
    $(document).ready(function(){
        $( "#myForm" ).validate( {
            rules: {
               
                name: {
                    required: true,
                    minlength: 3
                },
                mobile: {
                    number: true,
                    minlength: 11
                    
                },
                image: {
                    accept: "image/*",
                   
               },
                address: {
                    required: true,
                    minlength: 6
                },
               
                email: {
                    required: true,
                    email: true
                },
                gender: {
                    required: true,
                },
                
            },
            messages: {
                
                gender: {
                    required: "Please select your gender.", 
                },
                name: {
                    required: "Please enter name",
                    minlength: "Your username must consist of at least 3 characters"
                },
                mobile: {
                    minlength: "Your mobile number must consist of at least 11 characters",
                    number: "Mobile Number must be Numeric"
                },
                image: {   
                    accept: "Only Image",
                },
                address: {
                    required: "Please enter your Address",
                    minlength: "Your Address number must consist of at least 6 characters",
                    
                },
                email: "Please enter a valid email address",
                
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `invalid-feedback` class to the error element
                error.addClass( "invalid-feedback" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.next( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        } );

    });
</script> --}}

{{-- validation only name --}}
<script>


    function checkfirstname(){
        var firstName = $("#FullName").val();
        var reg = /^[a-zA-Z -.]{3,55}$/;

        var test =$("#FullName").attr("type");

        if(reg.test(firstName)){
            $("#name").text("")
            return true;
        }else {
            $("#name").text("Student Name formate is invalid.")
            return false;
        }
    }

    $("#FullName").keyup(function () {
            checkfirstname()
    });


    $("#myForm").submit(function () {
        if(checkfirstname() == true){
            return true;
        }else {
            return false;
        }
    });



</script>  
  
                

@endsection