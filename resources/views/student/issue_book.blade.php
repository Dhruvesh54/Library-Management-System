@extends('student.master')

@section('title')
    Issue Book
@endsection

@section('content')
    <div class="col-6 p-4">
        <div class="input-group input-group-outline">
            <label class="form-label ">Search here...</label>
            <input type="search" class="form-control" name="search" id="search" />
        </div>
    </div>


    <div class="row">
        <div class="col-7 col-md-7 col-sm-6">
            <div class="d-flex" id="search_div" style="gap: 1rem;flex-wrap:wrap;">
                @foreach ($fetch_book_data as $book)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-dark" style="font-weight: bolder;">{{ $book->book_name }}</h5>
                            <p class="card-text" style="font-weight: 700;">{{ $book->author }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">topic : {{ $book->topic }}</li>
                            <li class="list-group-item">language : {{ $book->language }}</li>
                            <li class="list-group-item">edition : {{ $book->edition }}</li>
                        </ul>
                        <div class="card-body">
                            <button type="button" data-book-code="{{ $book->book_code }}"
                                class="add_more btn text-white bg-primary">Issue Book</button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="col-5 col-md-5 col-sm-5">

            <div class="card my-2 ">
                <div class="card-header p-0 position-relative z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Book Issue Details</h6>
                    </div>
                </div>
                <div class="addMoreProduct">
                    <div class="d-flex row row-cols-1 row-cols-md-3 g-4" style="gap: 15px">
                        <div class="card-body-issue">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button"
                            class="submit_issued_books btn bg-gradient-primary  w-40 mt-2 mb-1">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            // ======================= Issue Book =======================

            let counter = 0;
            let issued_book_codes = [];
            $(document).ready(function() {

                let flag = true;
                $(document).on('click', '.add_more', function() {
                    var button = $(this); // Reference to the clicked button
                    var value = button.data('book-code');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('student.issue_bookk') }}",
                        data: {
                            book_code: value
                        },
                        success: function(data) {
                            // Check if the response has the expected structure
                            if (data && data.issue_book_data) {
                                var issueBookData = data.issue_book_data;

                                // if (value === issueBookData.bookCode) {
                                //     alert("You can't issue same book again.");
                                // } else {
                                var book_data = `
                        <div class="card-body">
                        <div class="card" style="width: 10rem;" data-book-code="${issueBookData.book_code}">
                            <h5 id="name_book">${issueBookData.book_name}</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item prod_rate">${issueBookData.author}</li>
                                <li class="list-group-item">${issueBookData.topic}</li>
                            </ul>
                        </div>
                        <button type="button" class="delete btn btn-primary" title="Remove field" id="remove"><i
                            class="fa fa-times"></i></button>
                            </div>
                    `;

                                for (const issued_book of issued_book_codes) {
                                    if (issued_book === value) {
                                        alert("You can't issue same book again");
                                        flag = false;
                                        // issued_book_codes.splice(issued_book, 1);
                                        // issued_book_codes.pop();
                                        var index = issued_book_codes.indexOf(issued_book);
                                        if (index !== -1) {
                                            issued_book_codes.splice(index, 1);
                                        }
                                    } else {
                                        flag = true;
                                    }
                                }
                                // console.log(flag, issued_book_codes);

                                if (flag) {
                                    $(book_data).insertBefore('.card-body-issue');
                                    counter++;
                                }
                                // console.log(counter);
                                // $(document).trigger('bookDataAdded');
                                setTimeout(function() {
                                        var bookCode = $('.card-body').last().find('.card')
                                            .data(
                                                'book-code');
                                        issued_book_codes.push(bookCode);
                                        // console.log(issued_book_codes);
                                    },
                                    100);


                                // Increment the counter
                                if (counter >= 3) {
                                    $(".add_more").prop("disabled", true);
                                    alert("You cannot issue more than three books at a time.");
                                } else {
                                    console.error("Invalid response structure");
                                }
                                // }
                            }
                        },
                        error: function(err) {
                            console.log(err.responseText);
                        }
                        // });
                    });

                    // ======================= Add Book =======================
                    // $(document).on('bookDataAdded', function() {
                    //     // Use a setTimeout to ensure that the book data is added to the DOM
                    //     setTimeout(function() {
                    //         // Retrieve values from the dynamically added book data
                    //         var bookCode = $('.card-body').last().find('.card').data(
                    //             'book-code');
                    //         issued_book_codes.push(bookCode);

                    //         // Use the retrieved values as needed
                    //         // console.log(bookCode);
                    //         // console.log(issued_book_codes);
                    //     }, 100);
                    // });


                    // ======================= Insert Book in Database =======================
                    // $('.submit_issued_books').on('click', function() {
                    //     // console.log("done");
                    //     if (issued_book_codes.length === 0) {
                    //         alert("Please select a book first.");
                    //     } else {
                    //         $.ajax({
                    //             type: 'GET',
                    //             url: '{{ route('student.store_issued_book') }}',
                    //             data: {
                    //                 issued_book_codes: issued_book_codes
                    //             },
                    //             success: function(response) {
                    //                 // Handle success response
                    //                 console.log(response);
                    //                 // alert('Book Issued Successfully.');
                    //                 // window.location = '{{ route('student.issued_book') }}';
                    //             },
                    //             error: function(error) {
                    //                 // Handle the error response from the controller
                    //                 console.error('Error storing books:', error
                    //                     .responseText);
                    //             }
                    //         });
                    //     }
                    // });

                    // $('.submit_issued_books').on('click', function() {
                    //     if (counter === 0) {
                    //         alert("Please select a book first.");
                    //     } else {
                    //         var issuedBookCodes = issued_book_codes;
                    //         // var comma_separated = issuedBookCodes.join(",");

                    //         // console.log(issuedBookCodes);
                    //         // Make an AJAX request to the controller
                    //         $.ajax({
                    //             type: 'GET', // Change to 'GET' if your controller method supports GET requests
                    //             url: '{{ route('student.store_issued_book') }}', // Replace with the actual route to your controller method
                    //             data: {
                    //                 issued_book_codes: issuedBookCodes
                    //             },
                    //             success: function(response) {
                    //                 // console.log('Books successfully stored:', response);
                    //                 alert("Book issued successfully");
                    //                 location.reload();
                    //                 window.location = '{{ route('student.issued_book') }}'
                    //             },
                    //             error: function(error) {
                    //                 alert("Error in issuing book");
                    //                 // Handle the error response from the controller
                    //                 console.error('Error storing books:', error
                    //                     .responseText);
                    //             }
                    //         });
                    //     }
                    // });



                    // ======================= Delete Book =======================
                    $('.addMoreProduct').delegate('.delete', 'click', function() {
                        var deletedBookCode = $(this).parent().find('.card').data('book-code');

                        // Remove the last occurrence of deletedBookCode from issued_book_codes
                        var index = issued_book_codes.lastIndexOf(deletedBookCode);
                        if (index !== -1) {
                            issued_book_codes.splice(index, 1);
                        }

                        $(this).parent().remove();
                        counter--;

                        if (counter === 3) {
                            $(".add_more").prop("disabled", true);
                        } else {
                            $(".add_more").prop("disabled", false);
                        }

                        console.log(counter);
                        console.log(issued_book_codes);
                    });




                });

            });


            // ======================= Book Search=======================

            $("#search").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('student.issue_book') }}", // Added a closing brace here
                    type: "GET",
                    data: {
                        search: value
                    },
                    success: function(data) {
                        var users = data.users;
                        var html = '';

                        if (users.length > 0) {
                            for (let i = 0; i < users.length; i++) {
                                html += `
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">${users[i]['book_name']}</h5>
                                        <p class="card-text">${users[i]['author']}</p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Topic : ${users[i]['topic']}</li>
                                        <li class="list-group-item">Language : ${users[i]['language']}</li>
                                        <li class="list-group-item">Edition : ${users[i]['edition']}</li>
                                    </ul>

                                    <div class="card-body">
                                        <button type="button" data-book-code="${users[i]['book_code']}"
                                            id="book_code" class="add_more selected btn text-white bg-gradient-primary">Issue Book </button>
                                    </div>
                                </div>
                                `;
                            }
                        } else {
                            html +=
                                '<h1 style="color: red;">Book`s not found...</h1>';
                        }
                        $("#search_div").html(html);
                    }
                });
            });


            $('.submit_issued_books').on('click', function() {
                if (counter === 0) {
                    alert("Please select a book first.");
                } else {
                    var issuedBookCodes = issued_book_codes;
                    // var comma_separated = issuedBookCodes.join(",");

                    // console.log(issuedBookCodes);
                    // Make an AJAX request to the controller
                    $.ajax({
                        type: 'GET', // Change to 'GET' if your controller method supports GET requests
                        url: '{{ route('student.store_issued_book') }}', // Replace with the actual route to your controller method
                        data: {
                            issued_book_codes: issuedBookCodes
                        },
                        success: function(response) {
                            // console.log('Books successfully stored:', response);
                            alert("Book issued successfully");
                            location.reload();
                            window.location = '{{ route('student.issued_book') }}'
                        },
                        error: function(error) {
                            alert("Error in issuing book");
                            // Handle the error response from the controller
                            console.error('Error storing books:', error
                                .responseText);
                        }
                    });
                }
            });
        </script>
    @endsection
