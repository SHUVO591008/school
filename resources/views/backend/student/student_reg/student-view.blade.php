
@extends('layouts.app')


@section('web')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
                    <!-- ============================================================== -->
            <div id="page-wrapper" class="gray-bg dashbard-1">
                        <!-- Start content -->
                <div class="content-main">
                    <div style="width: 1050px" class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                       Student List

                                    <a style="float: right" class="btn btn-success" href="{{ route('student.reg.add') }}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Student </a>


                                    </div>


                                    <?php
                                        if(isset($_GET['success'])) {
                                            echo '<div id="message" class="alert alert-success">roll number successfully inserted</div>';
                                        }
                                    ?>


                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <form id="myForm" action="{{ route('student.reg.search') }}" method="GET">


                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Class</label>
                                                        <select name="class_id" class="form-control" id="stu_class">
                                                            <option selected disabled>Select Class</option>
                                                            <option value="01">All Class</option>
                                                            @foreach ($class as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <span id="class_id" style="color: red"></span>

                                                        @error('class_id')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label style="color: black">Year</label>
                                                        <select name="year_id" class="form-control" id="year">
                                                            <option selected disabled>Select Year</option>
                                                            <option value="01">All Year</option>
                                                            @foreach ($year as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <span style="color: red" id="year_id">

                                                        </span>

                                                        @error('year_id')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                         @enderror
                                                    </div>

                                                    <div style="padding-top: 26px" class="form-group col-md-4">
                                                        <input class="btn btn-success" type="submit" value="Search">
                                                    </div>

                                                </form>

                                                <table id="datatable" class="table table-striped table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th width="10%">#SL</th>
                                                            <th>Name</th>
                                                            <th>ID NO</th>
                                                            <th>Roll</th>
                                                            <th>Year</th>
                                                            <th>Classc</th>

                                                            @if(Auth::user()->role=='Admin')
                                                            <th>Code</th>
                                                            @endif
                                                            <th style="width: 10%;text-align: center">Image</th>
                                                            <th width="20%">Action </th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        <?php $sl = 1 ?>

                                                        @if(@isset($assignstudent))
                                                            @foreach($assignstudent as $item)
                                                            
                                                                <tr class="{{ $item->id }}">
                                                                    <td>{{ $sl++ }}</td>
                                                                    <td>{{ $item['studentData']['name'] }}</td>
                                                                    <td>{{ $item['studentData']['id_no']  }}</td>
                                                                    <td>{{ $item->roll  }}</td>
                                                                    <td>{{ $item['year']['name'] }}</td>
                                                                    <td>{{ $item['class']['name'] }}</td>

                                                                    @if(Auth::user()->role=='Admin')
                                                                    <td>{{ $item['studentData']['code']  }}</td>
                                                                    @endif

                                                                    <td>
                                                                        <img style="width: 100%" src="{{ url($item['studentData']['image']) }}">
                                                                    </td>
                                                                    <td>
                                                                        <a style="background: #caff0069" href="{{route('student.reg.edit',$item->id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                                        </a>

                                                                        <a style="background: #caff0069" href="{{route('student.promotion',$item->id)}}" class="btn"><i class="fa fa-check"></i>
                                                                        </a>

                                                                        <a target="_blank" style="background: #caff0069" href="{{route('student.details',$item->id)}}" class="btn"><i class="fa fa-eye"></i>
                                                                        </a>


                                                                        </a>


                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @else
                                                        @foreach($data as $item)
                                                      

                                                      <tr class="{{ $item->id }}">
                                                          <td>{{ $sl++ }}</td>
                                                          <td>{{ $item['studentData']['name'] }}</td>
                                                          <td>{{ $item['studentData']['id_no']  }}</td>
                                                          <td>{{ $item->roll }}</td>
                                                          <td>{{ $item['year']['name'] }}</td>
                                                          <td>{{ $item['class']['name'] }}</td>
                                                          @if(Auth::user()->role=='Admin')
                                                          <td>{{ $item['studentData']['code']  }}</td>
                                                          @endif
                                                      
                                                          <td>
                                                              <img style="width: 100%" src="{{ url($item['studentData']['image']) }}">
                                                          </td>
                                                          <td>
                                                              <a style="background: #caff0069" href="{{route('student.reg.edit',$item->id)}}" class="btn btn-info "><i class="fa fa-edit"></i>
                                                              </a>
                                                      
                                                              <a style="background: #caff0069" href="{{route('student.promotion',$item->id)}}" class="btn"><i class="fa fa-check"></i>
                                                              </a>
                                                      
                                                              <a target="_blank" style="background: #caff0069" href="{{route('student.details',$item->id)}}" class="btn"><i class="fa fa-eye"></i>
                                                              </a>
                                                      
                                                      
                                                      
                                                          </td>
                                                      
                                                      </tr>
                                                      @endforeach
                                                        @endif



                                                    </tbody>
                                                </table>

                                            </div>
                                        </div> <!-- End Row panal -->
                                    </div>

                                </div> <!-- panel -->
                            </div> <!-- col-12 -->

                        </div> <!-- End Row -->
                    </div> <!-- container -->
                </div><!-- content -->
            </div><!-- content-page -->


<script>
       $(function(){
        setTimeout(function() {
            $("#message").hide('slow');
        }, 3000);
        });
</script>

{{-- validation --}}

<script>



     //  year
     function year(){
        var year = $("#year").val();
        var reg = /[0-9]|\./;


        if(reg.test(year)){
            $("#year_id").text("")
            return true;
        }else {
            $("#year_id").text("Year formate is invalid.")
            return false;
        }


    }

    $("#year").change(function () {
        year()
    });



    //  class
    function class1(){
        var class_id = $("#stu_class").val();
        var reg = /[0-9]|\./;

        // var test =$("#stu_class").attr("type");

        if(reg.test(class_id)){
            $("#class_id").text("")
            return true;
        }else {
            $("#class_id").text("Class formate is invalid.")
            return false;
        }


    }

    $("#stu_class").change(function () {
        class1()
    });




    $("#myForm").submit(function () {
        if(class1() == true & year() == true){
            return true;
        }else {
            return false;
        }
    });



</script>


@endsection
