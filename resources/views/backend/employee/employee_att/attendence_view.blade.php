
@extends('layouts.app')


@section('web')
    <style>
        a.nav-link {
            font-size: 12px;
            font-weight: 600;
            padding: 0.75rem 1rem 1rem;
            text-decoration: none;
            text-transform: uppercase;


        }

        .active {
            border-bottom: 3px solid burlywood;
        }

        .select2-container {
            width: 100%!important;
        }

    </style>

    {{-- date Picker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


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
                                <h2>Attendence Report</h2>

                            </div>

                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <form target="_blank" method="get" id="myForm" action="{{ route('Attendence.get') }}">


                                                <div class="add_item">

                                                    <div class="row">

                                                        <div class="form-group col-md-5">
                                                            <label style="color: black">Date</label>
                                                            <input id="date" placeholder="dd-mm-yy" type="text" name="date" value="" class="form-control" autocomplete="off" readonly>


                                                            <span id="dateerror" style="color: red"></span>

                                                            @error('date')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-5">
                                                            <label style="color: black;width: 100%">Name</label>
                                                            <select name="employee_id" class="form-control select2" id="employee_id">
                                                                <option selected disabled>Select Employee</option>
                                                                @foreach ($user as $key=> $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <br>
                                                            <span id="employee_iderror" style="color: red;display:block;"></span>

                                                            @error('employee_id')
                                                            <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                            @enderror
                                                        </div>

                                                        <div style="margin-top: 27px" class="form-group col-md-2">
                                                            <button class="btn btn-primary" type="submit">
                                                                Submit
                                                            </button>
                                                        </div>


                                                    </div>
                                                </div>



                                            </form>





                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div> <!-- panel -->
                    </div> <!-- col-12 -->

                </div> <!-- End Row -->


            </div> <!-- container -->

        </div><!-- content -->
    </div><!-- content-page -->



    {{-- Select 2 --}}
    <script>
        $(".select2").select2({
            tags: true
        });
    </script>



    {{-- validation --}}
{{--    <script>--}}
{{--        function datevalidation(){--}}
{{--            var datevali = $("#date").val();--}}
{{--            var reg = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;--}}

{{--            var test =$("#date").attr("type");--}}

{{--            if(reg.test(datevali)){--}}
{{--                $("#dateerror").text("")--}}
{{--                return true;--}}
{{--            }else {--}}
{{--                $("#dateerror").text("Date formate is invalid.")--}}
{{--                return false;--}}
{{--            }--}}
{{--        }--}}

{{--        $("#date").change(function () {--}}
{{--            datevalidation()--}}
{{--        });--}}



{{--        //  employee--}}
{{--        function employee(){--}}
{{--            var employee_id = $("#employee_id").val();--}}
{{--            var reg = /[0-9]|\./;--}}

{{--            if(reg.test(employee_id)){--}}
{{--                $("#employee_iderror").text("")--}}
{{--                return true;--}}
{{--            }else {--}}
{{--                $("#employee_iderror").text("Employee Name formate is invalid.")--}}
{{--                return false;--}}
{{--            }--}}


{{--        }--}}

{{--        $("#employee_id").change(function () {--}}
{{--            employee()--}}
{{--        });--}}
{{--        --}}

{{--        $("#myForm").submit(function () {--}}
{{--            if( employee() == true & datevalidation() == true){--}}
{{--                return true;--}}
{{--            }else {--}}
{{--                return false;--}}
{{--            }--}}
{{--        });--}}



{{--    </script>--}}




    {{-- date piker --}}
    <script>
        $(function(){
            $("input[name='date']").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true
            });
        });
    </script>


@endsection
