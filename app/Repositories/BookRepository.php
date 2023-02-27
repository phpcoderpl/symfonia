<?php

namespace App\Repositories;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    private $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function all()
    {
        return $this->bookModel->all();
    }

    public function addBook($data): bool
    {
        return $this->bookModel->save($data);

    }
}
