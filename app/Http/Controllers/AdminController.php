<?php

namespace App\Http\Controllers;

use App\Models\add_book;
use App\Models\issued_books;
use App\Models\registration;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use DataTables;
use App\DataTables\UsersDataTable;
use Yajra\DataTables\Services\DataTable;

class AdminController extends Controller {

    public AdminService $AdminService;
    public function __construct(AdminService $AdminService) {
        $this->AdminService = $AdminService;
    }

    public function Add_book() {

        // $lastDealer = DB::table('dealer')->latest('id')->first();

        $lastbook = add_book::latest('id')->first();
        if($lastbook) {
            // Extract the numeric part and increment it
            $lastCode = $lastbook->book_code;
            $numericPart = intval(substr($lastCode, 7));
            $nextNumericPart = str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT);
            $bookCode = 'Book-'.$nextNumericPart;
        } else {
            // If no dealer codes exist yet, start with Dealer-001
            $bookCode = 'Book-001';
        }
        return view('admin.add_book', ['bookCode' => $bookCode]);
    }

    public function Add_book_method(Request $request) {

        $data = $this->AdminService->book_add($request);
        if($data->save()) {
            session()->flash('success', 'Book Add Successfully.');
            return redirect()->route('admin.manage_book');
        } else {
            session()->flash('error', 'Book Add is fail.');
        }
    }

    public function Manage_book(Request $request) {
        $fetch_book_data = add_book::where('status', 'active')->get();
        // $fetch_book_data1 = add_book::where('status', 'active')->first();


        if($request->ajax() || $request->isXmlHttpRequest() || $request->wantsJson()) {
            $data = add_book::where('status', 'active')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barcode', function ($book) {
                    $barcodeHTML = DNS1D::getBarcodeHTML(" . $book->book_barcode . ", 'C39', 1, 50);
                    // echo $barcodeHTML.$book->book_barcode;
                    return sprintf($barcodeHTML.$book->book_barcode);
                })


                ->addColumn('edit', function ($book) {
                    return '<span class="badge badge-sm bg-warning"><a href="/admin/edit_book/'.$book->book_code.'" class="text-white">EDIT</a></span>';
                })
                ->addColumn('delete', function ($book) {
                    return '<span class="badge badge-sm bg-danger"><a href="/admin/delete_book/'.$book->book_code.'"class="text-white">DELETE</a></span>';
                })
                ->escapeColumns([])
                ->rawColumns(['edit', 'delete', 'barcode'])
                ->make(true);
        }
        return view('admin.manage_book');

    }

    public function data_table(UsersDataTable $dataTable) {
        // dd($dataTable);
        // return $dataTable->render('admin.demo');
    }
    // public function data_table(Request $request) {



    //     if($request->ajax() || $request->isXmlHttpRequest()||$request->wantsJson()) {
    //         $data = User::all();

    //         // dd($data);
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             // ->addColumn('barcode', function ($user) {
    //             //     // Assuming you have a 'book_barcode' column in your User model
    //             //     $barcodeHtml = '<img src="' . route('generateBarcode', ['barcode' => $user->book_barcode]) . '" alt="Barcode">';
    //             //     return $barcodeHtml;
    //             // })
    //             // ->addColumn('edit', function ($user) {
    //             //     return '<a href="' . route('admin.edit_user', ['id' => $user->id]) . '">Edit</a>';
    //             // })
    //             // ->addColumn('delete', function ($user) {
    //             //     return '<a href="' . route('admin.delete_user', ['id' => $user->id]) . '">Delete</a>';
    //             // })
    //             // ->rawColumns(['barcode', 'edit', 'delete'])
    //             ->make(true);
    //     }
    //     // return "hello";
    //     return view('admin.data_table');
    // }


    public function student(Request $request) {
        if($request->ajax() || $request->isXmlHttpRequest() || $request->wantsJson()) {
            $data = registration::where('role', 'student')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($student) {
                    return '<span class="badge badge-sm bg-warning"><a href="/admin/edit_student/'.$student->email.'" class="text-white">EDIT</a></span>';
                })
                // ->addColumn('delete', function ($student) {
                //     return '<span class="badge badge-sm bg-danger"><a href="/admin/activate_book/'.$student->email.'"class="text-white">DELETE</a></span>';
                // })
                ->rawColumns(['edit'])
                ->make(true);
        }
        return view('admin.student');
    }

    public function fetch_data_for_edit_student($email) {

        $student_data = registration::where('email', $email)->first();
        return view('admin.edit_student', compact('student_data'));
    }

    public function edit_student_action(Request $request) {
        $rules = [
            'name' => 'required|min:3|max:40',
            'mobile' => 'required|digits:10',
        ];
        $error_msg = [
            'name.required' => 'Fullname cannot be empty',
            'name.max' => 'Fullname must be at maximum 40 chracters',
            'name.min' => 'Fullname must be atleast 3 characters',
            'mobile.required' => 'Mobile number cannot be empty',
            'mobile.digits' => 'Mobile number must contain only 10 digits',
        ];
        $request->validate($rules, $error_msg);

        $add_user = new registration();

        $add_user->name = $request->name;
        $add_user->email = $request->email;
        $add_user->mobile = $request->mobile;
        $add_user->password = $request->pwd_confirmation;



        $data = registration::where('email', $request->email)->first();
        $data->where('email', $request->email)->update(
            array(
                'name' => $request->name,
                'mobile' => $request->mobile,
            )
        );

        if($data) {
            session()->flash('success', 'Student Data Update Successfully.');
            return redirect()->route('admin.student');
        }
        // elseif($data->status == 'deleted') {
        //     session()->flash('success', 'Book updated Successfully.');
        //     return redirect()->route('admin.deleted_books');
        // } else {
        //     session()->flash('error', 'Error in updating book.');
        //     return redirect()->route('admin.edit_book', ['book_code' => $request->book_code]);
        // }

    }
    public function Deleted_books(Request $request) {


        if($request->ajax() || $request->isXmlHttpRequest() || $request->wantsJson()) {
            $data = add_book::where('status', 'deleted')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($book) {
                    return '<span class="badge badge-sm bg-warning"><a href="/admin/edit_book/'.$book->book_code.'" class="text-white">EDIT</a></span>';
                })
                ->addColumn('delete', function ($book) {
                    return '<span class="badge badge-sm bg-secondary"><a href="/admin/activate_book/'.$book->book_code.'"class="text-white">REACTIVATE</a></span>';
                })
                ->rawColumns(['edit', 'delete'])
                ->make(true);
        }
        return view('admin.deleted_books');

        // $query = add_book::query();

        // if($request->ajax()) {
        //     $users = add_book::where('status', 'deleted')->where(function ($query) use ($request) {
        //         $query->orWhere('book_code', 'LIKE', '%'.$request->search.'%');
        //         $query->orWhere('book_barcode', 'LIKE', '%'.$request->search.'%');
        //         $query->orWhere('book_name', 'LIKE', '%'.$request->search.'%');
        //         $query->orWhere('topic', 'LIKE', '%'.$request->search.'%');
        //         $query->orWhere('author', 'LIKE', '%'.$request->search.'%');
        //         $query->orWhere('edition', 'LIKE', '%'.$request->search.'%');
        //         $query->orWhere('language', 'LIKE', '%'.$request->search.'%');
        //     })->get();
        //     return response()->json(['users' => $users]);
        // } else {
        //     return view('admin.deleted_books', compact('fetch_book_deleted_data'));
        // }
    }

    public function Activate_book($book_code) {
        $data = add_book::where('book_code', $book_code)->update(array('status' => 'active'));
        if($data) {
            session()->flash('success', 'Book Activeted Successfully.');
            return redirect()->route('admin.manage_book');
        }
    }

    public function fetch_data_for_edit_book($book_code) {

        $book_data = add_book::where('book_code', $book_code)->first();
        return view('admin.edit_book', compact('book_data'));
    }

    public function edit_book_action(Request $request) {
        $rules = [
            'name' => 'required|min:3|max:40',
            'topic' => 'required|min:3|max:40',
            'author' => 'required|min:3|max:40',
            'edition' => 'required|min:1|max:40',
            // 'quantity' => 'required|numeric',
            'language' => 'required|min:3|max:40',
        ];
        $error_msg = [
            'name.required' => 'Name name cannot be empty',
            'name.max' => 'Name name must be at maximum 40 chracters',
            'name.min' => 'Name name must be at less than 3 characters',

            'topic.required' => 'Topic name cannot be empty',
            'topic.max' => 'Topic name must be at maximum 40 chracters',
            'topic.min' => 'Topic name must be at less than 3 characters',

            'author.required' => 'Author name cannot be empty',
            'author.max' => 'Author name must be at maximum 40 chracters',
            'author.min' => 'Author name must be at less than 3 characters',

            'edition.required' => 'Edition name cannot be empty',
            'edition.max' => 'Edition name must be at maximum 40 chracters',
            'edition.min' => 'Edition name must be at less than 3 characters',

            // 'quentity.required' => 'quentity name cannot be empty',
            // 'quantity.numeric' => 'Quantity Filed must contain digits only',

            'language.required' => 'Language name cannot be empty',
            'language.max' => 'Language name must be at maximum 40 chracters',
            'language.min' => 'Language name must be at less than 3 characters',

        ];
        $request->validate($rules, $error_msg);


        $data = add_book::where('book_code', $request->book_code)->first();
        $data->where('book_code', $request->book_code)->update(
            array(
                'book_name' => $request->name,
                'topic' => $request->topic,
                'author' => $request->author,
                'edition' => $request->edition,
                // 'quantity' => $request->quantity,
                'language' => $request->language,
            )
        );

        if($data->status == 'active') {
            session()->flash('success', 'Book updated Successfully.');
            return redirect()->route('admin.manage_book');
        } elseif($data->status == 'deleted') {
            session()->flash('success', 'Book updated Successfully.');
            return redirect()->route('admin.deleted_books');
        } else {
            session()->flash('error', 'Error in updating book.');
            return redirect()->route('admin.edit_book', ['book_code' => $request->book_code]);
        }
    }
    public function delete_book($book_code) {
        $data = add_book::where('book_code', $book_code)->update(array('status' => 'deleted'));
        if($data) {
            session()->flash('success', 'Book Delete Successfully.');
            return redirect()->route('admin.deleted_books');
        }
    }

    public function Edit_book() {
        return view('admin.edit_book');
    }

    public function Issued_book() {


        $issued_book_data = issued_books::all();

        // $student_email = session()->get("student_email");
        // $student_id = Student::where("email", $student_email)->first()->id;
        $student_data_arr = [];
        foreach($issued_book_data as $value) {
            $student_data = registration::where('id', $value->student_id)->first();
            array_push($student_data_arr, $student_data);
        }
        // dd($student_data_arr);

        $fine = 0;
        $issuedBookData = [];
        foreach($issued_book_data as $book_code) {
            $book_data = add_book::where('book_code', $book_code->book_code)->first();

            //* Calculating Due Date
            $createdAtDate = Carbon::parse($book_code->created_at);
            $dueDate = $createdAtDate->addDays(5);

            $formattedCreatedAtDate = $book_code->created_at->toDateString();
            $formattedDueDate = $dueDate->toDateString();
            //* Calculating Fine
            $currentDate = Carbon::now();
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
            // dump($book_code->book_code);
        }

        if(!empty($issuedBookData)) {
            return view('admin.issued_student_book', compact('issued_book_data', 'issuedBookData', 'formattedCreatedAtDate', 'formattedDueDate', 'fine', 'student_data_arr'));
        } else {
            return view('admin.issued_student_book', compact('issued_book_data'));
        }

    }
}
