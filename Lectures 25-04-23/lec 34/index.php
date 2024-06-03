<?php
class Book
{
    private string $title;
    private string $author;
    private int $publicationYear;
    private string $isbn;

    public function __construct(string $title, string $author, int $publicationYear, string $isbn)
    {
        $this->title = $title;
        $this->author = $author;
        $this->publicationYear = $publicationYear;
        $this->isbn = $isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPublicationYear(): int
    {
        return $this->publicationYear;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function __clone()
    {
        $this->isbn = uniqid();
    }
}

class Library
{
    private array $books = [];

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function removeBook(string $isbn): void
    {
        foreach ($this->books as $key => $book) {
            if ($book->getIsbn() === $isbn) {
                unset($this->books[$key]);
                break;
            }
        }
    }

    public function findBook(string $isbn): ?Book
    {
        foreach ($this->books as $book) {
            if ($book->getIsbn() === $isbn) {
                return $book;
            }
        }
        return null;
    }

    public function cloneBook(string $isbn): ?Book
    {
        foreach ($this->books as $book) {
            if ($book->getIsbn() === $isbn) {
                $clone = clone $book;
                $this->books[] = $clone;
                return $clone;
            }
        }
        return null;
    }

    public function printBooks(): void
    {
        echo "Books in the library:" . "<br>";
        foreach ($this->books as $book) {
            echo "Title: " . $book->getTitle() . "<br>";
            echo "Author: " . $book->getAuthor() . "<br>";
            echo "Publication Year: " . $book->getPublicationYear() . "<br>";
            echo "ISBN: " . $book->getIsbn() . "<br>" . "<br>";
        }
    }
}

$library = new Library();
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 1925, "978-3-16-148410-0");
$book2 = new Book("To Kill a Mockingbird", "Harper Lee", 1960, "978-0-06-112008-4");
$book3 = new Book("1984", "George Orwell", 1949, "978-0-14-103614-4");
$book4 = new Book("Narnia", "C.S.Lewwis", 1950, "978-1987711222");

$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);
$library->addBook($book4);
$library->printBooks();
$clone = $library->cloneBook("978-3-16-148410-0");
if ($clone) {
    echo "Cloned book: " . $clone->getTitle() . "<br>";
} else {
    echo "Book not found in library." . "<br>";
}
$library->removeBook("978-0-06-112008-4");
$library->printBooks();
?>
