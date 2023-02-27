<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreateBookRequest;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;


class BooksController extends Controller
{

    private $bookRepository;

    public function __construct(BookRepository $repository)
    {
        $this->bookRepository = $repository;
    }

    public function index()
    {
        return view('books.index', [
            'books' => $this->bookRepository->all()
        ]);
    }

    public function store(): JsonResponse
    {
      //  $this->bookRepository->addBook($request);
        return response()->json(['OK']);
    }

}

