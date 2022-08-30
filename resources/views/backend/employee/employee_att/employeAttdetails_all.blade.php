
@extends('layouts.app')


@section('web')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">


<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div style="width: 1050px" class="container">
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="page-title">Attendance Sheet</h4>
                        </div>
                    </div>

                    {{-- <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <label class="focus-label">Employee Name</label>
                                <input type="text" class="form-control floating">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus select-focus">
                                <label class="focus-label">Select Month</label>
                                <select class="select floating">
                                    <option>-</option>
                                    <option>Jan</option>
                                    <option>Feb</option>
                                    <option>Mar</option>
                                    <option>Apr</option>
                                    <option>May</option>
                                    <option>Jun</option>
                                    <option>Jul</option>
                                    <option>Aug</option>
                                    <option>Sep</option>
                                    <option>Oct</option>
                                    <option>Nov</option>
                                    <option>Dec</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus select-focus">
                                <label class="focus-label">Select Year</label>
                                <select class="select floating">
                                    <option>-</option>
                                    <option>2017</option>
                                    <option>2016</option>
                                    <option>2015</option>
                                    <option>2014</option>
                                    <option>2013</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="#" class="btn btn-success btn-block"> Search </a>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            @foreach ($date as $key=> $item)
                                            <th width="20%">{{ date('d-M-Y',strtotime($item->date)) }}</th>
                                            @endforeach

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user as $key=> $item)

                                        <?php

                                        $test = App\model\EmployeAttendence::where('employee_id',$item->employee_id)->get(); 
                                
                                        ?>
                                            <tr>
                                                <td>{{ $item['user']['name'] }}</td>
                                                @foreach ($test as $value)
                                                    <td>{{ $value->att_stutas }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/popper.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

@endsection