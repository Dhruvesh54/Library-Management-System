<?php
namespace App\Services;

use App\Models\add_book;
use App\Models\issued_books;
use App\Models\registration;
use Illuminate\Http\Request;


class AdminService {
    public function book_add(Request $request) {
        $length = 10; // Length of numeric part
        $characters = '0123456789';
        $prefix = 'DK';

        $numeric_part = '';

        for($i = 0; $i < $length; $i++) {
            $numeric_part .= $characters[rand(0, strlen($characters) - 1)];
        }

        $book_barcode = $prefix.$numeric_part;

        $rules = [
            'topic' => 'required|min:3|max:40',
            'name' => 'required|min:3|max:40',
            'author' => 'required|min:3|max:40',
            'edition' => 'required|min:1|max:40',
            // 'quantity' => 'required|numeric',
            'language' => 'required|min:3|max:40',
        ];
        $error_msg = [
            'name.required' => 'Name name cannot be empty',
            'name.max' => 'Name name must be at maximum 40 chracters',
            'name.min' => 'Name name must be at lethan 3 characters',

            'topic.required' => 'Topic name cannot be empty',
            'topic.max' => 'Topic name must be at maximum 40 chracters',
            'topic.min' => 'Topic name must be at lethan 3 characters',

            'author.required' => 'Author name cannot be empty',
            'author.max' => 'Author name must be at maximum 40 chracters',
            'author.min' => 'Author name must be at lethan 3 characters',

            'edition.required' => 'Edition name cannot be empty',
            'edition.max' => 'Edition name must be at maximum 40 chracters',
            'edition.min' => 'Edition name must be at lethan 3 characters',

            // 'quantity.required' => 'Quantity name cannot be empty',
            // 'quantity.numeric' => 'Quantity Filed must contain digits only',

            'language.required' => 'Language name cannot be empty',
            'language.max' => 'Language name must be at maximum 40 chracters',
            'language.min' => 'Language name must be at lethan 3 characters',

        ];
        $request->validate($rules, $error_msg);

        $add_book = new add_book();

        $add_book->book_code = $request->book_code;
        $add_book->book_barcode = $book_barcode;
        $add_book->book_name = $request->name;
        $add_book->topic = $request->topic;
        $add_book->author = $request->author;
        $add_book->edition = $request->edition;
        // $add_book->quantity = $request->quantity;
        $add_book->language = $request->language;

        return $add_book;
    }
}