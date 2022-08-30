
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
                                <h3>Manage Marksheet Generate</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="display: none" class="alert alert-success" id="msg_div">
                                        <span id="res_message"></span>
                                    </div>
                                </div>
                            </div>



                        <form method="get" action="{{route('MarkSheet.get')}}" target="_blank">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label style="color: #0b0b0b">Year</label>
                                        <select name="year" class="form-control select2" id="year_id">
                                            <option selected disabled>--Select Year--</option>
                                            @foreach ($years as $key=> $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span id="year_iderror" style="color: red;display:block;"></span>

                                        @error('year')
                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label style="color: #0b0b0b">Class</label>
                                        <select name="class" class="form-control select2" id="class_id">

                                            <option selected disabled>--Select Class--</option>
                                            @foreach ($class as $key=> $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span id="class_iderror" style="color: red;display:block;"></span>

                                        @error('class')
                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label style="color: #0b0b0b">Exam Type</label>
                                        <select name="exam_type" class="form-control select2" id="exam_type_id">
                                            <option selected disabled>--Exam Type--</option>
                                            @foreach ($ExamType as $key=> $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span id="exam_type_iderror" style="color: red;display:block;"></span>

                                        @error('exam_type')
                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label style="color: #0b0b0b">ID No</label>
                                        <input id="idNo" class="form-control" type="text" name="id_no" placeholder="Id No">
                                        <br>
                                        <span id="id_noerror" style="color: red;display:block;"></span>

                                        @error('id_no')
                                        <span style="color: red;font-size: 12px" class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="col-md-4">
                                        <button class="btn btn-success" type="submit" id="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                    </div>

                                </div>
                            </div>
                        </form>

                            <hr>


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
<script>
    $(document).on('click','#search',function(){


        var class_id = $('#class_id').val();
        var year_id = $('#year_id').val();
        var idNo = $('#idNo').val();
        var exam_type_id = $('#exam_type_id').val();


        $('.notifyjs-corner').html('');


        if(class_id==null){
            $.notify("class field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(year_id==null){
            $.notify("Year field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(idNo==''){
            $.notify("ID field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }
        if(exam_type_id==null){
            $.notify("Exam type field is required!", {globalPosition:'top right',className:'error'});
            return false;
        }

    });


</script>







@endsection
