<?php

use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\ShiftController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\SubjectController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return redirect('/');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // For users
    Route::prefix('users')->group(function(){
        Route::get('/view', [UserController::class, 'view'])->name('users.view');
        Route::get('/add', [UserController::class, 'add'])->name('users.add');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    // For Profile
    Route::prefix('profiles')->group(function(){
        Route::get('/view', [ProfileController::class, 'view'])->name('profiles.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::post('/store', [ProfileController::class, 'update'])->name('profiles.update');
        Route::get('/password/view', [ProfileController::class, 'passwordView'])->name('profiles.password.view');
        Route::post('/password/update', [ProfileController::class, 'passwordUpdate'])->name('profiles.password.update');
    });

    // For student class setup
    Route::prefix('setups')->group(function(){
        Route::get('/student/class/view', [StudentClassController::class, 'view'])->name('setups.student.class.view');
        Route::get('/student/class/add', [StudentClassController::class, 'add'])->name('setups.student.class.add');
        Route::post('/student/class/store', [StudentClassController::class, 'store'])->name('setups.student.class.store');
        Route::get('/student/class/edit/{id}', [StudentClassController::class, 'edit'])->name('setups.student.class.edit');
        Route::post('/student/class/update/{id}', [StudentClassController::class, 'update'])->name('setups.student.class.update');
        Route::get('/student/class/delete/{id}', [StudentClassController::class, 'delete'])->name('setups.student.class.delete');

        //Student Year
        Route::get('/student/year/view', [StudentYearController::class, 'view'])->name('setups.student.year.view');
        Route::get('/student/year/add', [StudentYearController::class, 'add'])->name('setups.student.year.add');
        Route::post('/student/year/store', [StudentYearController::class, 'store'])->name('setups.student.year.store');
        Route::get('/student/year/edit/{id}', [StudentYearController::class, 'edit'])->name('setups.student.year.edit');
        Route::post('/student/year/update/{id}', [StudentYearController::class, 'update'])->name('setups.student.year.update');

        //Student Group
        Route::get('/student/group/view', [StudentGroupController::class, 'view'])->name('setups.student.group.view');
        Route::get('/student/group/add', [StudentGroupController::class, 'add'])->name('setups.student.group.add');
        Route::post('/student/group/store', [StudentGroupController::class, 'store'])->name('setups.student.group.store');
        Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'edit'])->name('setups.student.group.edit');
        Route::post('/student/group/update/{id}', [StudentGroupController::class, 'update'])->name('setups.student.group.update');

        //Student Shift
        Route::get('/student/shift/view', [ShiftController::class, 'view'])->name('setups.student.shift.view');
        Route::get('/student/shift/add', [ShiftController::class, 'add'])->name('setups.student.shift.add');
        Route::post('/student/shift/store', [ShiftController::class, 'store'])->name('setups.student.shift.store');
        Route::get('/student/shift/edit/{id}', [ShiftController::class, 'edit'])->name('setups.student.shift.edit');
        Route::post('/student/shift/update/{id}', [ShiftController::class, 'update'])->name('setups.student.shift.update');
        
        //Student Fee Category
        Route::get('/fee/category/view', [FeeCategoryController::class, 'view'])->name('setups.fee.category.view');
        Route::get('/fee/category/add', [FeeCategoryController::class, 'add'])->name('setups.fee.category.add');
        Route::post('/fee/category/store', [FeeCategoryController::class, 'store'])->name('setups.fee.category.store');
        Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'edit'])->name('setups.fee.category.edit');
        Route::post('/fee/category/update/{id}', [FeeCategoryController::class, 'update'])->name('setups.fee.category.update');

        //Student Fee Category Amount
        Route::get('/fee/amount/view', [FeeAmountController::class, 'view'])->name('setups.fee.amount.view');
        Route::get('/fee/amount/add', [FeeAmountController::class, 'add'])->name('setups.fee.amount.add');
        Route::post('/fee/amount/store', [FeeAmountController::class, 'store'])->name('setups.fee.amount.store');
        Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'edit'])->name('setups.fee.amount.edit');
        Route::post('/fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'update'])->name('setups.fee.amount.update');
        Route::get('/fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'details'])->name('setups.fee.amount.details');

        //Exam Type
        Route::get('/exam/type/view', [ExamTypeController::class, 'view'])->name('setups.exam.type.view');
        Route::get('/exam/type/add', [ExamTypeController::class, 'add'])->name('setups.exam.type.add');
        Route::post('/exam/type/store', [ExamTypeController::class, 'store'])->name('setups.exam.type.store');
        Route::get('/exam/type/edit/{id}', [ExamTypeController::class, 'edit'])->name('setups.exam.type.edit');
        Route::post('/exam/type/update/{id}', [ExamTypeController::class, 'update'])->name('setups.exam.type.update');

        //Subjects
        Route::get('/subject/view', [SubjectController::class, 'view'])->name('setups.subject.view');
        Route::get('/subject/add', [SubjectController::class, 'add'])->name('setups.subject.add');
        Route::post('/subject/store', [SubjectController::class, 'store'])->name('setups.subject.store');
        Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('setups.subject.edit');
        Route::post('/subject/update/{id}', [SubjectController::class, 'update'])->name('setups.subject.update');
        
        //Assign Subjects
        Route::get('/asign/subject/view', [AssignSubjectController::class, 'view'])->name('setups.assign.subject.view');
        Route::get('/asign/subject/add', [AssignSubjectController::class, 'add'])->name('setups.assign.subject.add');
        Route::post('/asign/subject/store', [AssignSubjectController::class, 'store'])->name('setups.assign.subject.store');
        Route::get('/asign/subject/edit/{class_id}', [AssignSubjectController::class, 'edit'])->name('setups.assign.subject.edit');
        Route::post('/asign/subject/update/{class_id}', [AssignSubjectController::class, 'update'])->name('setups.assign.subject.update');
        Route::get('/asign/subject/details/{class_id}', [AssignSubjectController::class, 'details'])->name('setups.assign.subject.details');

        //Designation
        Route::get('/designation/view', [DesignationController::class, 'view'])->name('setups.designation.view');
        Route::get('/designation/add', [DesignationController::class, 'add'])->name('setups.designation.add');
        Route::post('/designation/store', [DesignationController::class, 'store'])->name('setups.designation.store');
        Route::get('/designation/edit/{id}', [DesignationController::class, 'edit'])->name('setups.designation.edit');
        Route::post('/designation/update/{id}', [DesignationController::class, 'update'])->name('setups.designation.update');
    });

    
    Route::prefix('students')->group(function(){
        // Manage Students Registration
        Route::get('/reg/view', [StudentRegController::class, 'view'])->name('students.registration.view');
        Route::get('/reg/add', [StudentRegController::class, 'add'])->name('students.registration.add');
        Route::post('/reg/store', [StudentRegController::class, 'store'])->name('students.registration.store');
        Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'edit'])->name('students.registration.edit');
        Route::post('/reg/update/{student_id}', [StudentRegController::class, 'update'])->name('students.registration.update');
        Route::get('/year-class-search', [StudentRegController::class, 'year_class_search'])->name('students.year.class.search');
        Route::get('/reg/promotion/{student_id}', [StudentRegController::class, 'promotion'])->name('students.registration.promotion');
        Route::post('/reg/promotion/store/{student_id}', [StudentRegController::class, 'promotionStore'])->name('students.registration.promotion.store');
        Route::get('/reg/details/{student_id}', [StudentRegController::class, 'details'])->name('students.registration.details');
        
        //Genarate Student Roll No
        Route::get('/roll/view', [StudentRollController::class, 'view'])->name('students.roll.view');
        Route::get('/roll/get-student', [StudentRollController::class, 'getStudent'])->name('students.registration.get-student');
        Route::post('/roll/store', [StudentRollController::class, 'store'])->name('students.roll.store');
    });

});