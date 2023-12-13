<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\demo;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('login');
});

Route::get('logout', [LoginController::class, 'Logout']);

Route::get('datatable', [StudentController::class, 'datatable']);
Route::get('get_user', [AdminController::class, 'data_table'])->name('admin.user');

// Route::view('demo','admin.demo');



Route::prefix('student')->group(function () {
    Route::middleware(['user_authentication'])->group(function () {
        Route::get('issue_book', [StudentController::class, 'Issue_book'])->name('student.issue_book');
        Route::get('issued_book', [StudentController::class, 'Issued_book'])->name('student.issued_book');
        Route::get('store_issued_book', [StudentController::class, 'Store_issued_book'])->name('student.store_issued_book');


        Route::post('user', [StudentController::class, 'Loadmore'])->name('student.issue_bookk');

        Route::get('return_issued_book/{book_code}', [StudentController::class, 'return_issued_book'])->name('student.return_issued_book');
    });




    Route::post('login_authentication', [LoginController::class, 'Login_authentication'])->name('student.login_authentication_method');
    Route::get('login', [StudentController::class, 'Login'])->name('student.login');
    Route::get('Registratiom', [StudentController::class, 'Signup'])->name('student.registratiom');

    Route::post('add_user', [StudentController::class, 'Registration'])->name('student.add_user');

});


Route::prefix('admin')->group(function () {

    Route::middleware(['admin_authentication'])->group(function () {
        Route::get('add_book', [AdminController::class, 'Add_book'])->name('admin.add_book');
        Route::get('admin_issued_book', [AdminController::class, 'Issued_book'])->name('admin.issued_book_student');
        Route::get('manage_book', [AdminController::class, 'Manage_book'])->name('admin.manage_book');
        Route::get('Deleted_books', [AdminController::class, 'Deleted_books'])->name('admin.deleted_books');
        Route::get('student', [AdminController::class, 'student'])->name('admin.student');



        // Route::get('get_user', [AdminController::class, 'data_table'])->name('admin.user');

        Route::post('edit_student', [AdminController::class, 'edit_student_action'])->name('admin.update_student_method');
        Route::get('edit_student/{email}', [AdminController::class, 'fetch_data_for_edit_student'])->name('admin.edit_student');


        //CRUD == Books
        Route::get('edit_book/{book_code}', [AdminController::class, 'fetch_data_for_edit_book'])->name('admin.edit_book');
        Route::get('delete_book/{book_code}', [AdminController::class, 'delete_book'])->name('admin.delete_book');
        Route::get('activate_book/{book_code}', [AdminController::class, 'Activate_book']);
        Route::post('edit_book', [AdminController::class, 'edit_book_action'])->name('admin.update_book_method');


        Route::post('add_book', [AdminController::class, 'Add_book_method'])->name('admin.add_book_method');

    });

});
