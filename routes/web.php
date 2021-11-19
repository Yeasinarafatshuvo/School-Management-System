<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentFeeCategory;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\ExamtypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

// user management all route
Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'EditUser'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'UpdateUser'])->name('users.update');
    Route::get('/delete/{id}', [UserController::class, 'DeleteUser'])->name('users.delete');

});

//user profile and change password

Route::prefix('profile')->group(function(){
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');


});

//setup routes
Route::prefix('setups')->group(function(){
    //students class route
    Route::get('student/class/view', [StudentController::class, 'StudentView'])->name('student.class.view');
    Route::get('student/class/add', [StudentController::class, 'StudentClassAdd'])->name('student.clas.add');
    Route::post('student/class/store', [StudentController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentController::class, 'StudentClassUpdate'])->name('update.student.class');
    Route::get('student/class/delete/{id}', [StudentController::class, 'StudentClassDelete'])->name('student.class.delete');
    
    //students year routes
    Route::get('student/year/view', [StudentYearController::class, 'YearView'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');
    Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('student/year/updaet/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');

    //Students group routes
    Route::get('student/group/view', [StudentGroupController::class, 'GroupView'])->name('student.group.view');
    Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');
    Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');
    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
    Route::post('student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');
    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');

    //Students Shift
    Route::get('student/shift/view', [StudentShiftController::class, 'ShiftView'])->name('student.shift.view');
    Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');
    Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');
    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');
    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');
    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');

    //Fee Category
    Route::get('fee/category/view', [StudentFeeCategory::class, 'ViewFeeCat'])->name('fee.category.view');
    Route::get('fee/category/add', [StudentFeeCategory::class, 'FeeCatAdd'])->name('fee.cat.add');
    Route::post('fee/category/store', [StudentFeeCategory::class, 'FeeCatStore'])->name('store.fee.cat');
    Route::get('fee/category/edit/{id}', [StudentFeeCategory::class, 'FeeCatEdit'])->name('fee.cat.edit');
    Route::post('fee/category/updaet/{id}', [StudentFeeCategory::class, 'FeeCatUpdate'])->name('update.fee.cat');
    Route::get('fee/category/delete/{id}', [StudentFeeCategory::class, 'FeeCatDelete'])->name('fee.cat.delete');

    //Fee category Amount Routes
    Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');
    Route::get('fee/amount/add', [FeeAmountController::class, 'FeeAmountAdd'])->name('fee.amount.add');
    Route::post('fee/amount/store', [FeeAmountController::class, 'FeeAmountStore'])->name('store.fee.amount');
    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit'])->name('fee.amount.edit');
    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'FeeAmountUpdate'])->name('update.fee.amount');
    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');

    //exam type
    Route::get('exam/type/view', [ExamtypeController::class, 'ViewExamType'])->name('exam.type.view');
    Route::get('exam/type/add', [ExamtypeController::class, 'ExamTypeAdd'])->name('exam.type.add');
    Route::post('exam/type/store', [ExamtypeController::class, 'ExamTypeStore'])->name('exam.type.store');
    Route::get('exam/type/edit/{id}', [ExamtypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
    Route::post('exam/type/upate/{id}', [ExamtypeController::class, 'ExamTypeUpdate'])->name('exam.type.update');
    Route::get('exam/type/delete/{id}', [ExamtypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');

    //school subject List
    Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');
    Route::get('school/subject/add', [SchoolSubjectController::class, 'SchoolSubjectAdd'])->name('school.subject.add');
    Route::post('school/subject/store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('store.school.subject');
    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');
    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('update.school.subject');
    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');

    //Assign Subject  
    Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');
    Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');
    Route::post('assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');
    Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');
    Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');
    Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'DetailsAssignSubject'])->name('assign.subject.details');


    //Designation 

    Route::get('designation/view', [DesignationController::class, 'DesignationView'])->name('designation.view');
    Route::get('designation/add', [DesignationController::class, 'DesignationAdd'])->name('designation.add');
    Route::post('designation/store', [DesignationController::class, 'DesignationStore'])->name('store.designation');
    Route::get('designation/edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');
    Route::post('designation/update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('update.designation');
    Route::get('designation/deleted/{id}', [DesignationController::class, 'DesignationDeleted'])->name('designation.delete');

});
