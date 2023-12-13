<?php

namespace App\Http\Controllers;

use App\Models\add_book;
use App\Models\issued_books;
use App\Models\registration;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class StudentController extends Controller {

    public StudentService $abc;

    public function __construct(StudentService $abc) {
        $this->abc = $abc;
    }

    public function datatable() {
        $data = add_book::all();
        // $data = add_book::where('status', 'active')->get();


        return view("datatable", compact("data"));
    }
    public function Loadmore(Request $request) {

        $book_code = $request->input('book_code');

        $issue_book_data = add_book::where('book_code', $book_code)->first();

        // dump($issue_book_data);
        return response()->json(['res' => 'done', 'issue_book_data' => $issue_book_data]);

    }


    public function Store_issued_book(Request $request) {
        $issuedBookCodes = $request->input('issued_book_codes', []);

        $student_email = session()->get("studentuser");
        $student_id = registration::where("email", $student_email)->first()->id;
        foreach($issuedBookCodes as $key => $value) {
            $update_book_status = add_book::where('book_code', $value)->update(['status' => 'issued']);
            // dd($issue_book_data);
            $issue_books_add = new issued_books();
            $issue_books_add->student_id = $student_id;
            $issue_books_add->book_code = $value;
            $complete = $issue_books_add->save();
        }

        if($complete && $update_book_status) {
            session()->flash('success', 'Book Issued Successfully.');
            return redirect()->route('student.issued_book');
        } else {
            session()->flash('error', 'Book Not Issued.');
        }

    }

    public function Issue_book(Request $request) {

        $query = add_book::query();

        $fetch_book_data = add_book::where('status', 'active')->get();

        if($request->ajax()) {
            $users = add_book::where('status', 'active')->where(function ($query) use ($request) {
                $query->orWhere('book_name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('book_code', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('author', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('topic', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('edition', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('language', 'LIKE', '%'.$request->search.'%');
            })->get();
            return response()->json(['users' => $users]);
        } else {
            return view("student.issue_book", compact('fetch_book_data'));
        }

    }

    public function Issued_book(Request $request) {

        $student_email = session()->get("studentuser");
        $student_id = registration::where("email", $student_email)->first()->id;

        $fine = 0;

        $issued_books_data = issued_books::where('student_id', $student_id)->get();
        $issued_books_data1 = issued_books::where('student_id', $student_id)->first();

        $issuedBookData = [];
        foreach($issued_books_data as $book_code) {
            $book_data = add_book::where('book_code', $book_code->book_code)->first();

            //* Calculating Due Date
            $createdAtDate = Carbon::parse($book_code->created_at);
            $dueDate = $createdAtDate->addDays(1);

            $formattedCreatedAtDate = $book_code->created_at->toDateString();
            $formattedDueDate = $dueDate->toDateString();
            //* Calculating Fine
            $currentDate = Carbon::now();
            // dd($formattedCreatedAtDate, $formattedDueDate);
            // $date = date_create("2023-12-10");
            // $formatedDate = Carbon::parse($date);
            // dd($formatedDate->diffInDays($dueDate));
            $daysDifference = $currentDate->diffInDays($dueDate) + 1;
            if($currentDate->lt($dueDate)) {
                if($dueDate->gt($currentDate)) {
                    // echo "fine : 0";
                } else {
                    if($daysDifference > 0) {
                        $fine = $daysDifference * 5;
                    } else {
                        $fine = 0;
                    }
                }
            } else {
                $fine = 0;
            }

            array_push($issuedBookData, $book_data);
        }

        if(!empty($issuedBookData)) {
            return view('student.issued_book', compact('issued_books_data1', 'issuedBookData', 'formattedCreatedAtDate', 'formattedDueDate', 'fine'));
        } else {
            return view('student.issued_book', compact('issued_books_data', 'issuedBookData'));
        }


    }
    public function Login() {
        return view("login");
    }


    public function Signup() {
        return view("signup");
    }

    public function Registration(Request $request) {
        $data = $this->abc->registration_student($request);
        if($data->save()) {
            session()->flash('success', 'Registration Successfully.');
            return redirect()->route('student.login');
        } else {
            session()->flash('error', 'Registration is fail.');
            return redirect()->route('student.registratiom');
        }
    }


    public function return_issued_book($book_code) {
        $return_book = issued_books::where('book_code', $book_code)->delete();
        $update_book_status = add_book::where('book_code', $book_code)->update(['status' => 'active']);

        if($return_book && $update_book_status) {
            session()->flash('success', 'Book Returned Successfully.');
            return redirect()->route('student.issued_book');
        } else {
            session()->flash('error', 'Error in returning book.');
        }
    }
}
