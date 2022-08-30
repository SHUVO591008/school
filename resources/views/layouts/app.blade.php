<?php
$recever=Route::input('id');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>School Managment</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="{{asset('css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{asset('js/jquery.min.js')}}"> </script>


<!-- Mainly scripts -->
<script src="{{asset('js/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
<!-- Custom and plugin javascript -->
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/screenfull.js')}}"></script>


<!-- DataTables -->
<link href="{{ asset('datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

{{-- <!-- image Uploder -->
<link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.min') }}">
<script type="text/javascript" src="{{ asset('js/image-uploader.min.js') }}"></script> --}}

{{-- sweetalert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    b#smsnum {
    background: yellow;
    padding: 10px;
    border-radius: 50%;
    float: right;
    font-size: 15px;
}
</style>

@toastr_css
</head>
<body>

     <!-- Authentication Links -->
@guest


@else


<div id="wrapper">
        <!----->
    <nav class="navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1> <a style="font-size: 23px" class="navbar-brand" href="{{ route('home') }}">School Managment</a></h1>
        </div>





                    <!-- Brand and toggle get grouped for better mobile display -->

                <!-- Collect the nav links, forms, and other content for toggling -->
    <div style="width: 32%;" class="drop-men" >
        <ul class=" nav_1">

            <li class="dropdown at-drop">
                <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i class="fa fa-globe"></i> <span class="number">5</span></a>
        <ul class="dropdown-menu menu1 " role="menu">
                <li>
                    <a href="#">

                    <div class="user-new">
                        <p>New user registered</p>
                        <span>40 seconds ago</span>
                    </div>

                    <div class="user-new-left">
                        <i class="fa fa-user-plus"></i>
                    </div>

                    <div class="clearfix"> </div>
                    </a>
                </li>

        <li>
            <a href="#">
            <div class="user-new">
            <p>Someone special liked this</p>
            <span>3 minutes ago</span>
            </div>
            <div class="user-new-left">


                        <i class="fa fa-heart"></i>
                        </div>
                <div class="clearfix"> </div>
                                </a>
                            </li>
                                <li><a href="#">
                                    <div class="user-new">
                                    <p>John cancelled the event</p>
                                    <span>4 hours ago</span>
                                    </div>
                                    <div class="user-new-left">

                                    <i class="fa fa-times"></i>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a></li>
                                <li><a href="#">
                                    <div class="user-new">
                                    <p>The server is status is stable</p>
                                    <span>yesterday at 08:30am</span>
                                    </div>
                                    <div class="user-new-left">

                                    <i class="fa fa-info"></i>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a></li>
                                <li><a href="#">
                                    <div class="user-new">
                                    <p>New comments waiting approval</p>
                                    <span>Last Week</span>
                                    </div>
                                    <div class="user-new-left">

                                    <i class="fa fa-rss"></i>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a></li>
                                <li><a href="#" class="view">View all messages</a></li>
                            </ul>
                            </li>

                            <li style="width: 50%" class="dropdown">
                            <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret">{{ Auth::user()->name }}<i class="caret"></i></span>
                                <img style="width: 28%;height: 28%;" src="{{(!empty(Auth::user()->image))?url(Auth::user()->image):url('profile/avatar.png') }}" alt="">
                            </a>

                            <ul class="dropdown-menu " role="menu">
                            <li><a href="profile.html"><i class="fa fa-user"></i>Edit Profile</a></li>
                            <li><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox</a></li>
                            <li><a href="calendar.html"><i class="fa fa-calendar"></i>Calender</a></li>
                            <li><a href="inbox.html"><i class="fa fa-clipboard"></i>Tasks</a></li>
                            <li>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>Log Out
                            </a>

                        </li>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>

                        </ul>


                        </li>

                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <div class="clearfix">

            </div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                            <li>
                                <a href="{{ route('home') }}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                            </li>

                        @if (Auth::user()->role=="Admin")
                            <li>
                                <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Manage User</span><span class="fa arrow"></span></a>

                                <ul class="nav nav-second-level">
                                    <li>
                                        <a class=" hvr-bounce-to-right" href="{{ route('users.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>View User</a>
                                    </li>
                                    <li>
                                        <a class=" hvr-bounce-to-right" href="{{ route('users.add') }}"><i class="fa fa-user-plus nav_icon" aria-hidden="true"></i>User Add</a>
                                    </li>
                                </ul>
                            </li>
                        @endif


                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Manage Profile</span><span class="fa arrow"></span></a>

                                <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('profile.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>You'r Profile</a>
                                </li>
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('password') }}"><i class="fa fa-user-plus nav_icon" aria-hidden="true"></i>Change Password</a>
                                </li>
                                </ul>
                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Manage Setup</span><span class="fa arrow"></span>
                            </a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.class.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Student Class</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.year.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>View Year</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.group.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Setup Group</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.shift.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Setup Shift</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.fee.category.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Fee Category</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.fee.amount.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Fee Category Amount</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.exam.type.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Student Exam Type</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.subject.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Student Subject</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('students.assign.subject.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Assign Subject</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('designation.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Designation</a>
                                </li>

                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Manage Student</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('student.reg.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Student Registration</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('rollgenerate') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Roll Generate</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('registration.fee') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Registration Fee</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('monthly.fee') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Monthly Fee</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('exam.fee') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Exam Fee</a>
                                </li>

                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Manage Employe</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('employe.reg.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Employe Registration</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('employe.salary.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Employe Salary</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('employe.leave.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Employe Leave</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('employe.attendences.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Employe Attendence</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('employe.monthly.salary.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Employe Monthly Salary</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Manage Marks</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('student.marks.add') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Marks Entry</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('student.marks.edit') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Marks Edit</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('marks.grade.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Grade Point</a>
                                </li>

                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Accounts Manage</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('accounts.fee.grade.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Student Fee</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('accounts.employee.salary.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Employee Salary</a>
                                </li>


                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Expenses</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('accounts.cost.add') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Add Expense</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('accounts.cost.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Manage Expense</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('accounts.cost.category.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Expense Category</a>
                                </li>


                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Report Managment</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('report.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Monthly Profit/Loss</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('MarkSheet.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Mark sheet</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('AllMarkSheet.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>All Student Mark sheet</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('Attendence.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Attendence Report</a>
                                </li>

                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('IdCar.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Student ID Card</a>
                                </li>




                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Soft Delete system</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a class=" hvr-bounce-to-right" href="{{ route('soft') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Category</a>
                                </li>

                            </ul>

                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Messages</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a  class=" hvr-bounce-to-right" href="{{ route('messages') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Messenger </a>

                                </li>

                            </ul>

                        </li>

                        <!-- Division to village setup -->
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">Division to village </span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a  class=" hvr-bounce-to-right" href="{{ route('division.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Division </a>

                                </li>

                            </ul>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a  class=" hvr-bounce-to-right" href="{{ route('district.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>District </a>

                                </li>

                            </ul>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a  class=" hvr-bounce-to-right" href="{{ route('upazila.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Upazila </a>

                                </li>

                            </ul>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a  class=" hvr-bounce-to-right" href="{{ route('union.view') }}"><i class="fa fa-eye nav_icon" aria-hidden="true"></i>Union </a>

                                </li>

                            </ul>
                            

                        </li>







                </ul>
            </div>
        </div>
    </nav>
</div>



 @endguest




@yield('web')



<!--scrolling js-->
    <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <!--//scrolling js-->
    <script src="{{asset('js/bootstrap.min.js')}}"> </script>

    {{-- datatable --}}
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.js') }}"></script>

    {{-- jQuery Validation --}}
    <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validates.js') }}"></script>

    {{-- notify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous"></script>

    {{-- handalbar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>








    {{-- datatable script --}}
<script type="text/javascript">

    $(document).ready(function() {
        $('#datatable').dataTable();
    });
</script>


{{-- delet --}}
<script>
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
    });
</script>
{{-- delet --}}

<script>
    setInterval(seenMessage,1000);
    setInterval(allMessageView,1000);


    function seenUpdate() {
       $.ajax({
           type:'get',
           url:'{{URL::to('/seenUpdate')}}',
           datatype:'html'
       });
   }

   function singleSeenUpdate(id) {
    var sender=id;
    $.ajax({
        type:'get',
        url:'{{URL::to('/singleSeenUpdate')}}/'+sender,
        datatype:'html'
    });
}

    function seenMessage() {
        $.ajax({
            type:'get',
            url:'{{URL::to('/seen')}}',
            datatype:'html',
            success:function(data){
                if(data > 0){
                    $('#smsnum').show();
                    $('#smsnum').html(data);
                }else{
                    $('#smsnum').hide();
                }

            }
        });
    }





    function allMessageView() {
        $.ajax({
            type:'get',
            url:'{{URL::to('/allmessageview')}}',
            datatype:'html',
            success:function(response){
                $('#all-chat-message').html(response);
            }
        });
    }


</script>





</body>

@toastr_js
@toastr_render

</html>
