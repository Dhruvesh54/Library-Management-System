<?php
namespace App\Services;

use App\Models\add_book;
use App\Models\issued_books;
use App\Models\registration;
use Illuminate\Http\Request;


class StudentService {
    public function registration_student(Request $request) {
        $rules = [
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:registration,email',
            'pwd' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/',
            'pwd_confirmation' => 'required',
            'mobile' => 'required|digits:10',
        ];
        $error_msg = [
            'name.required' => 'Fullname cannot be empty',
            'name.max' => 'Fullname must be at maximum 40 chracters',
            'name.min' => 'Fullname must be atleast 3 characters',
            'email.required' => 'Email address cannot be empty',
            'email.email' => 'Invalid email address',
            'email.unique' => 'Email address already registered',
            'pwd.required' => 'Password cannot be empty',
            'pwd.confirmed' => 'Password and Confirm Password must match',
            'pwd.regex' => 'Password must contain one digit,one character both upper and lower and a special character',
            'pwd_confirmation.required' => 'Confirm Password cannot be empty',
            'mobile.required' => 'Mobile number cannot be empty',
            'mobile.digits' => 'Mobile number must contain only 10 digits',
        ];
        $request->validate($rules, $error_msg);

        $add_user = new registration();

        $add_user->name = $request->name;
        $add_user->email = $request->email;
        $add_user->mobile = $request->mobile;
        $add_user->password = $request->pwd_confirmation;

        return $add_user; //->saveOrFail();
    }

    public function issued_book_fatch() {


        
        $student_email = session()->get("studentuser");
        $student_id = registration::where("email", $student_email)->first()->id;

        $issued_books_data = issued_books::where('student_id', $student_id)->get();

        //* Refactored
        $books_code_arr = [];
        foreach($issued_books_data as $bookD) {
            $individual_codes = explode(',', $bookD->book_code);
            $books_code_arr = array_merge($books_code_arr, $individual_codes);
        }

        $issuedBookData = [];
        foreach($books_code_arr as $bookIssued) {
            $BOOK_DATA = add_book::where('book_code', $bookIssued)->first();
            array_push($issuedBookData, $BOOK_DATA);
        }

        $returnArrs = [];
        array_push($returnArrs, $issuedBookData);
        array_push($returnArrs, $issued_books_data);
        return $returnArrs;

        // return view('student.issued_books', compact('issued_books_data', 'issuedBookData'));


        // $issued_data = issued_books::where('status', 'issued')
        //     ->where('student_id', $student_id)
        //     ->get();

        // return $issued_data;
    }
}