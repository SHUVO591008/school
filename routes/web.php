<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes(['verify' => true]);

Auth::routes();



//User Route
Route::group(['middleware' => ['auth','admin']], function () {

    //admin dashboard
    Route::get('/', function(){
        return view('auth.login');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('users')->group(function () {
        Route::get('/view', 'UserController@index')->name('users.view');
        Route::get('/add', 'UserController@Useradd')->name('users.add');
        Route::post('/store', 'UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
        Route::get('/view/{id}', 'UserController@show')->name('users.single');
        Route::post('/update/{id}', 'UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'UserController@destroy')->name('users.delete');

    });

    //Profile Route
    Route::prefix('profile')->group(function () {

        Route::get('/view', 'profileController@index')->name('profile.view');
        Route::get('/edit/{id}', 'profileController@edit')->name('profile.edit');
        Route::post('/update/{id}', 'profileController@update')->name('profile.update');

    });

//Password Change Route
    Route::prefix('change')->group(function () {
        Route::get('/password', 'passwordController@index')->name('password');
        Route::post('/password', 'passwordController@store')->name('password.change');
    });



//student Class
Route::prefix('setup')->group(function () {
    //class setup
    Route::get('/class/view', 'backend\setup\studentClassController@index')->name('students.class.view');
    Route::get('/class/add', 'backend\setup\studentClassController@add')->name('students.class.add');
    Route::post('/class/store', 'backend\setup\studentClassController@store')->name('students.class.store');
    Route::get('/class/edit/{id}', 'backend\setup\studentClassController@edit')->name('students.class.edit');
    Route::post('/class/update/{id}', 'backend\setup\studentClassController@update')->name('students.class.update');
    Route::post('/class/delete', 'backend\setup\studentClassController@destroy')->name('students.class.delete');
    //year/session setup
    Route::get('/year/view', 'backend\setup\studentYearController@index')->name('students.year.view');
    Route::get('/year/add', 'backend\setup\studentYearController@add')->name('students.year.add');
    Route::post('/year/store', 'backend\setup\studentYearController@store')->name('students.year.store');
    Route::get('/year/edit/{id}', 'backend\setup\studentYearController@edit')->name('students.year.edit');
    Route::post('/year/update/{id}', 'backend\setup\studentYearController@update')->name('students.year.update');
    Route::post('/year/delete', 'backend\setup\studentYearController@destroy')->name('students.year.delete');
    //student Group setup
    Route::get('/group/view', 'backend\setup\studentGroupController@index')->name('students.group.view');
    Route::get('/group/add', 'backend\setup\studentGroupController@add')->name('students.group.add');
    Route::post('/group/store', 'backend\setup\studentGroupController@store')->name('students.group.store');
    Route::get('/group/edit/{id}', 'backend\setup\studentGroupController@edit')->name('students.group.edit');
    Route::post('/group/update/{id}', 'backend\setup\studentGroupController@update')->name('students.group.update');
    Route::post('/group/delete', 'backend\setup\studentGroupController@destroy')->name('students.group.delete');
    //student Shift
    Route::get('/shift/view', 'backend\setup\studentShiftController@index')->name('students.shift.view');
    Route::get('/shift/add', 'backend\setup\studentShiftController@add')->name('students.shift.add');
    Route::post('/shift/store', 'backend\setup\studentShiftController@store')->name('students.shift.store');
    Route::get('/shift/edit/{id}', 'backend\setup\studentShiftController@edit')->name('students.shift.edit');
    Route::post('/shift/update/{id}', 'backend\setup\studentShiftController@update')->name('students.shift.update');
    Route::post('/shift/delete', 'backend\setup\studentShiftController@destroy')->name('students.shift.delete');
    //student Fee Category
    Route::get('/fee/category/view', 'backend\setup\studentFeeCategoryController@index')->name('students.fee.category.view');
    Route::get('/fee/category/add', 'backend\setup\studentFeeCategoryController@add')->name('students.fee.category.add');
    Route::post('/fee/category/store', 'backend\setup\studentFeeCategoryController@store')->name('students.fee.category.store');
    Route::get('/fee/category/edit/{id}', 'backend\setup\studentFeeCategoryController@edit')->name('students.fee.category.edit');
    Route::post('/fee/category/update/{id}', 'backend\setup\studentFeeCategoryController@update')->name('students.fee.category.update');
    Route::post('/fee/category/delete', 'backend\setup\studentFeeCategoryController@destroy')->name('students.fee.category.delete');
    //student Fee Amount
    Route::get('/fee/amount/view', 'backend\setup\studentFeeAmountController@index')->name('students.fee.amount.view');
    Route::get('/fee/amount/add', 'backend\setup\studentFeeAmountController@add')->name('students.fee.amount.add');
    Route::post('/fee/amount/store', 'backend\setup\studentFeeAmountController@store')->name('students.fee.amount.store');
    Route::get('/fee/amount/edit/{fee_category_id}', 'backend\setup\studentFeeAmountController@edit')->name('students.fee.amount.edit');
    Route::post('/fee/amount/update/{fee_category_id}', 'backend\setup\studentFeeAmountController@update')->name('students.fee.amount.update');
    Route::get('/fee/amount/{fee_category_id}','backend\setup\studentFeeAmountController@view')->name('students.fee.amount.category.view');
     //student Exam type
     Route::get('/exam/type/view', 'backend\setup\studentExamTypeController@index')->name('students.exam.type.view');
     Route::get('/exam/type/add', 'backend\setup\studentExamTypeController@add')->name('students.exam.type.add');
     Route::post('/exam/type/store', 'backend\setup\studentExamTypeController@store')->name('students.exam.type.store');
     Route::get('/exam/type/edit/{id}', 'backend\setup\studentExamTypeController@edit')->name('students.exam.type.edit');
     Route::post('/exam/type/update/{id}', 'backend\setup\studentExamTypeController@update')->name('students.exam.type.update');
     Route::post('/exam/type/delete', 'backend\setup\studentExamTypeController@destroy')->name('students.exam.type.delete');
     //student subject
     Route::get('subject/view', 'backend\setup\studentSubjectController@index')->name('students.subject.view');
     Route::get('subject/add', 'backend\setup\studentSubjectController@add')->name('students.subject.add');
     Route::post('subject/store', 'backend\setup\studentSubjectController@store')->name('students.subject.store');
     Route::get('subject/edit/{id}', 'backend\setup\studentSubjectController@edit')->name('students.subject.edit');
     Route::post('subject/update/{id}','backend\setup\studentSubjectController@update')->name('students.subject.update');
     Route::post('subject/delete', 'backend\setup\studentSubjectController@destroy')->name('students.subject.delete');
     //student Assign Subject
    Route::get('/assign/subject/view', 'backend\setup\studentassignsubjectController@index')->name('students.assign.subject.view');
    Route::get('/assign/subject/add', 'backend\setup\studentassignsubjectController@add')->name('students.assign.subject.add');
    Route::post('/assign/subject/store', 'backend\setup\studentassignsubjectController@store')->name('students.assign.subject.store');
    Route::get('/assign/subject/edit/{class_id}', 'backend\setup\studentassignsubjectController@edit')->name('students.assign.subject.edit');
    Route::post('/assign/subject/update/{class_id}', 'backend\setup\studentassignsubjectController@update')->name('students.assign.subject.update');
    Route::get('/assign/subject/{class_id}','backend\setup\studentassignsubjectController@view')->name('students.assign.subject.category.view');

    //Designation
    Route::get('designation/view', 'backend\setup\designationController@index')->name('designation.view');
    Route::get('designation/add', 'backend\setup\designationController@add')->name('designation.add');
    Route::post('designation/store', 'backend\setup\designationController@store')->name('designation.store');
    Route::get('designation/edit/{id}', 'backend\setup\designationController@edit')->name('designation.edit');
    Route::post('designation/update/{id}','backend\setup\designationController@update')->name('designation.update');
    Route::post('designation/delete', 'backend\setup\designationController@destroy')->name('designation.delete');

});

Route::prefix('student')->group(function () {
    //student Registration
    Route::get('reg/view', 'backend\student\StudentRegController@index')->name('student.reg.view');
    Route::get('reg/add', 'backend\student\StudentRegController@add')->name('student.reg.add');
    Route::post('reg/store', 'backend\student\StudentRegController@store')->name('student.reg.store');
    Route::get('reg/edit/{id}', 'backend\student\StudentRegController@edit')->name('student.reg.edit');
    Route::post('reg/update/{id}','backend\student\StudentRegController@update')->name('student.reg.update');
    Route::post('reg/delete', 'backend\student\StudentRegController@destroy')->name('student.reg.delete');
    Route::get('reg/search', 'backend\student\StudentRegController@search')->name('student.reg.search');
    Route::get('reg/promotion/{id}', 'backend\student\StudentRegController@promotion')->name('student.promotion');
    Route::post('reg/promotion/store/{id}', 'backend\student\StudentRegController@promotionstore')->name('student.promotion.store');
    Route::get('reg/details/{id}', 'backend\student\StudentRegController@details')->name('student.details');

    //roll generate
    Route::get('roll/generate', 'backend\student\StudentRollgenerateController@rollgenerate')->name('rollgenerate');
    Route::post('roll/validate','backend\student\StudentRollgenerateController@validation')->name('rollgenerate.validate');
    Route::get('reg/getstudent', 'backend\student\StudentRollgenerateController@search')->name('getstudent.search');

    //student Registration Fee
    Route::get('registration/fee', 'backend\student\StudentRegistrationFeeController@generate')->name('registration.fee');
    Route::get('registration/get-student', 'backend\student\StudentRegistrationFeeController@getstudent')->name('registration.getStudent');
    Route::get('registration/get-student/pay-slip', 'backend\student\StudentRegistrationFeeController@payslip')->name('registration.getStudent.payslip');

    //student monthly Fee
    Route::get('monthly/fee', 'backend\student\StudentMonthlyFeeController@generate')->name('monthly.fee');
    Route::get('monthly/get-student', 'backend\student\StudentMonthlyFeeController@getstudent')->name('monthly.getStudent');
    Route::get('monthly/get-student/pay-slip', 'backend\student\StudentMonthlyFeeController@payslip')->name('monthly.getStudent.payslip');

    //student exam Fee
    Route::get('exam/fee', 'backend\student\StudentExamFeeController@generate')->name('exam.fee');
    Route::get('exam/get-student', 'backend\student\StudentExamFeeController@getstudent')->name('exam.getStudent');
    Route::get('exam/get-student/pay-slip', 'backend\student\StudentExamFeeController@payslip')->name('exam.getStudent.payslip');



});


Route::prefix('employees')->group(function () {
    //employee reg
    Route::get('/reg/view', 'backend\employees\EmployeRegControlle@index')->name('employe.reg.view');
    Route::get('/reg/add', 'backend\employees\EmployeRegControlle@add')->name('employe.reg.add');
    Route::post('/reg/store', 'backend\employees\EmployeRegControlle@store')->name('employe.reg.store');
    Route::get('/reg/edit/{id}', 'backend\employees\EmployeRegControlle@edit')->name('employe.reg.edit');
    Route::get('/reg/view/{id}', 'backend\employees\EmployeRegControlle@show')->name('employe.reg.single');
    Route::post('/reg/update/{id}', 'backend\employees\EmployeRegControlle@update')->name('employe.reg.update');
    Route::get('/reg/delete', 'backend\employees\EmployeRegControlle@destroy')->name('employe.reg.delete');
     //employee salary
     Route::get('/salary/view', 'backend\employees\EmployeSalaryController@index')->name('employe.salary.view');
     Route::get('/salary/increment/{id}', 'backend\employees\EmployeSalaryController@increment')->name('employe.salary.increment');
     Route::post('/salary/increment/store/{id}', 'backend\employees\EmployeSalaryController@incrementstore')->name('employe.salary.increment.store');
     Route::get('/salary/view/{id}', 'backend\employees\EmployeSalaryController@show')->name('employe.salary.single');
    //employee Leave
    Route::get('/leave/view', 'backend\employees\EmployeLeaveControlle@index')->name('employe.leave.view');
    Route::get('/leave/add', 'backend\employees\EmployeLeaveControlle@add')->name('employe.leave.add');
    Route::post('/leave/store', 'backend\employees\EmployeLeaveControlle@store')->name('employe.leave.store');
    Route::get('/leave/edit/{id}', 'backend\employees\EmployeLeaveControlle@edit')->name('employe.leave.edit');
    Route::post('/leave/update/{id}', 'backend\employees\EmployeLeaveControlle@update')->name('employe.leave.update');
     //employee Attendent
     Route::get('attendences/view', 'backend\employees\EmployeAttendencesControlle@index')->name('employe.attendences.view');
     Route::get('attendences/add', 'backend\employees\EmployeAttendencesControlle@add')->name('employe.attendences.add');
     Route::post('attendences/store', 'backend\employees\EmployeAttendencesControlle@store')->name('employe.attendences.store');
     Route::get('attendences/edit/{date}', 'backend\employees\EmployeAttendencesControlle@edit')->name('employe.attendences.edit');
     Route::get('attendences/details/{date}', 'backend\employees\EmployeAttendencesControlle@details')->name('employe.attendences.details');
     Route::get('attendences/date-wise-attendence', 'backend\employees\EmployeAttendencesControlle@detailsall')->name('attendences.details.all');
     //employee Monthly Salary
     Route::get('monthly/salary/view', 'backend\employees\EmployeMonthlySalaryControlle@view')->name('employe.monthly.salary.view');
     Route::get('monthly/salary/get-Salary', 'backend\employees\EmployeMonthlySalaryControlle@getSalary')->name('employe.monthly.salary.get');
     Route::get('monthly/salary/pay-slip/{employee_id}', 'backend\employees\EmployeMonthlySalaryControlle@payslip')->name('employe.monthly.salary.pay-slip');


});


Route::prefix('marks')->group(function () {
   //Marks Entry
    //Route::get('/student/view', 'backend\marks\marksController@index')->name('student.marks.view');
   Route::get('/student/add', 'backend\marks\marksController@add')->name('student.marks.add');
   Route::post('/student/store', 'backend\defaultController@store')->name('student.marks.store');
   //Marks edit
   Route::get('/student/edit', 'backend\marks\marksController@edit')->name('student.marks.edit');
   Route::post('/student/update', 'backend\defaultController@update')->name('student.marks.update');
   //Marks grade point
    Route::get('/grade/view', 'backend\marks\MarksGradeControlle@index')->name('marks.grade.view');
    Route::get('/grade/add', 'backend\marks\MarksGradeControlle@add')->name('marks.grade.add');
    Route::post('/grade/store', 'backend\marks\MarksGradeControlle@store')->name('marks.grade.store');
    Route::get('/grade/edit/{id}', 'backend\marks\MarksGradeControlle@edit')->name('marks.grade.edit');
    Route::post('/grade/update/{id}', 'backend\marks\MarksGradeControlle@update')->name('marks.grade.update');


});

Route::group(['prefix' => 'accounts'], function () {
     //Student Fee
     Route::get('/student/fee/view', 'backend\Accounts\StudentFeeController@index')->name('accounts.fee.grade.view');
     Route::get('/student/fee/add', 'backend\Accounts\StudentFeeController@add')->name('accounts.fee.grade.add');
     Route::post('/student/fee/store', 'backend\Accounts\StudentFeeController@store')->name('accounts.fee.grade.store');
     Route::get('/student/get-student', 'backend\Accounts\StudentFeeController@getStudent')->name('accounts.fee.get-student');
      //Employee salary
    Route::get('/employee/salary/view', 'backend\Accounts\EmployeeSalaryController@index')->name('accounts.employee.salary.view');
    Route::get('/employee/salary/add', 'backend\Accounts\EmployeeSalaryController@add')->name('accounts.employee.salary.add');
    Route::get('/employee/get-employee', 'backend\Accounts\EmployeeSalaryController@getemployee')->name('accounts.employee.get-employee');
    Route::post('/employee/salary/store', 'backend\Accounts\EmployeeSalaryController@store')->name('accounts.employee.salary.store');

    //Cost Category
    Route::get('/cost/category/view', 'backend\Accounts\CostCategoryController@index')->name('accounts.cost.category.view');
    Route::get('/cost/category/add', 'backend\Accounts\CostCategoryController@add')->name('accounts.cost.category.add');
    Route::get('/cost/category/edit/{id}', 'backend\Accounts\CostCategoryController@edit')->name('accounts.cost.category.edit');
    Route::post('/cost/category/update/{id}', 'backend\Accounts\CostCategoryController@update')->name('accounts.cost.category.update');
    Route::post('/cost/category/store', 'backend\Accounts\CostCategoryController@store')->name('accounts.cost.category.store');
    Route::post('/cost/category/delete', 'backend\Accounts\CostCategoryController@destroy')->name('accounts.cost.category.delete');


     //Cost add
     Route::get('/cost/view', 'backend\Accounts\CostController@index')->name('accounts.cost.view');
     Route::get('/cost/add', 'backend\Accounts\CostController@add')->name('accounts.cost.add');
     Route::post('/cost/store', 'backend\Accounts\CostController@store')->name('accounts.cost.store');

     Route::get('/cost/edit/{id}', 'backend\Accounts\CostController@edit')->name('accounts.cost.edit');
     Route::post('/cost/update/{id}', 'backend\Accounts\CostController@update')->name('accounts.cost.update');
     Route::post('/cost/delete', 'backend\Accounts\CostController@destroy')->name('accounts.cost.delete');

});

Route::group(['prefix' => 'report'], function () {
    //Report
    Route::get('/report/view', 'backend\Report\ProfitController@index')->name('report.view');
    Route::get('/report/get', 'backend\Report\ProfitController@profit')->name('report.profit');
    Route::get('/report/pdf', 'backend\Report\ProfitController@pdf')->name('report.pdf');
});

//marksheet
Route::group(['prefix' => 'marksheet'], function () {
    Route::get('/mark-sheet/view', 'backend\marksheet\marksheetController@index')->name('MarkSheet.view');
    Route::get('/mark-sheet/get', 'backend\marksheet\marksheetController@get')->name('MarkSheet.get');
//  Route::get('/mark-sheet/pdf', 'backend\marksheet\marksheetController@pdf')->name('MarkSheet.pdf');
    //All Student Marksheet
    Route::get('/all-student/view', 'backend\marksheet\marksheetController@allmarksheet')->name('AllMarkSheet.view');
    Route::get('/all-student/get', 'backend\marksheet\marksheetController@allmarksheetget')->name('AllMarkSheet.get');


});

//ID Card
Route::group(['prefix' => 'IDcard'], function () {
    Route::get('/view', 'backend\IdCard\IdCardController@index')->name('IdCar.view');
    Route::get('/get', 'backend\IdCard\IdCardController@show')->name('IdCar.get');


});



//Attendence Report
Route::group(['prefix' => 'attendence'], function () {
    Route::get('/report/view', 'backend\employees\EmployeAttendencesControlle@view')->name('Attendence.view');
    Route::get('/report/get', 'backend\employees\EmployeAttendencesControlle@get')->name('Attendence.get');

});


Route::get('/get-student', 'backend\defaultController@getStudent')->name('get-student');
Route::get('/get-student/marks', 'backend\defaultController@getStudentMarks')->name('get-student-marks');
Route::get('/get-subject', 'backend\defaultController@getSubject')->name('marks-getSubject');
Route::get('/cost/search', 'backend\defaultController@costSearch')->name('cost-search');
Route::get('/cost/reset', 'backend\defaultController@costReset')->name('cost-reset');





});


//SoftDelete Route
Route::prefix('soft')->group(function () {
    Route::get('/view', 'softDeleteController@index')->name('soft');
    Route::post('/store', 'softDeleteController@store')->name('store');
    Route::get('/delete/{id}', 'softDeleteController@softDelete')->name('delete');
    Route::get('/delete/permanently/{id}', 'softDeleteController@permanently')->name('permanently');
    Route::get('/restore/{id}', 'softDeleteController@restore')->name('restore');

});

//messages Route
Route::prefix('messages')->group(function () {

    Route::get('/view', 'messagesController@index')->name('messages');
    Route::get('/{id}', 'messagesController@index');
    Route::get('/chat/{id}',  'messagesController@callmessage');
    Route::post('/send-message','messagesController@store');

    Route::post('/typing','messagesController@typing');
    Route::get('/typing-receve/{id}','messagesController@typinc_receve');
    Route::get('/deletemessage/{id}','messagesController@deletemessage');

});

Route::get('/allmessage', 'messagesController@allmessage');


    Route::get('/seen/','messagesController@seenMessage');
    Route::get('/seenUpdate/','messagesController@seenUpdate');
    Route::get('/allmessageview/','messagesController@allMessageView');
    Route::get('/singleSeenUpdate/{id}','messagesController@singleSeenUpdate');

 

//    Division to village setup
//Division
    Route::prefix('division')->group(function () {
        Route::get('/view', 'DivisionController@index')->name('division.view');
        Route::get('/add', 'DivisionController@Divisionadd')->name('division.add');
        Route::post('/store', 'DivisionController@store')->name('division.store');
        Route::get('/edit/{id}', 'DivisionController@edit')->name('division.edit');
        Route::post('/update/{id}', 'DivisionController@update')->name('division.update');
        Route::post('/delete', 'DivisionController@destroy')->name('division.delete');

    });

//District 
    Route::prefix('district')->group(function () {
        Route::get('/view', 'districtController@index')->name('district.view');
        Route::get('/add', 'districtController@districtadd')->name('district.add');
        Route::post('/store', 'districtController@store')->name('district.store');
        Route::get('/edit/{id}', 'districtController@edit')->name('district.edit');
        Route::post('/update/{id}', 'districtController@update')->name('district.update');
        Route::post('/delete', 'districtController@destroy')->name('district.delete');

        Route::get('/get-district-name', 'backend\defaultController@getDistrictName')->name('get.district.name');

    });

    //Upazila 
    Route::prefix('upazila')->group(function () {
        Route::get('/view', 'upazilaController@index')->name('upazila.view');
        Route::get('/add', 'upazilaController@upazilaadd')->name('upazila.add');
        Route::post('/store', 'upazilaController@store')->name('upazila.store');
        Route::get('/edit/{id}', 'upazilaController@edit')->name('upazila.edit');
        Route::post('/update/{id}', 'upazilaController@update')->name('upazila.update');
        Route::post('/delete', 'upazilaController@destroy')->name('upazila.delete');

        Route::get('/get-upazila-name', 'backend\defaultController@getUpazilatName')->name('get.upazila.name');
        Route::get('/get-district', 'backend\defaultController@getDistrict')->name('get.district');
    });

    //union 
    Route::prefix('union')->group(function () {
        Route::get('/view', 'unionController@index')->name('union.view');
        Route::get('/add', 'unionController@unionadd')->name('union.add');
        Route::post('/store', 'unionController@store')->name('union.store');
        Route::get('/edit/{id}', 'unionController@edit')->name('union.edit');
        Route::post('/update/{id}', 'unionController@update')->name('union.update');
        Route::post('/delete', 'unionController@destroy')->name('union.delete');
        Route::get('/get-upazila', 'backend\defaultController@getUpazila')->name('get.upazila');

    });
    
    Route::get('display-user', [UserController::class, 'index']);






















