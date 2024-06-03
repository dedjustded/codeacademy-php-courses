<?php

class Book implements Serializable
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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getPublicationYear(): int
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(int $publicationYear): void
    {
        $this->publicationYear = $publicationYear;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function __clone()
    {
        $this->isbn = uniqid();
    }

    public function serialize()
    {
        return serialize([
            'title' => $this->title,
            'author' => $this->author,
            'publicationYear' => $this->publicationYear,
            'isbn' => $this->isbn,
        ]);
    }

    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->publicationYear = $data['publicationYear'];
        $this->isbn = $data['isbn'];
    }
}

class Library implements ArrayAccess, Countable, Serializable
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

    public function offsetExists($offset)
    {
        foreach ($this->books as $book)
        {
            if ($book->getIsbn() === $offset) {
            return true;
            }
            }
            return false;
            }
            public function offsetGet($offset)
            {
                return $this->findBook($offset);
            }
            
            public function offsetSet($offset, $value)
            {
                if (!$value instanceof Book) {
                    throw new InvalidArgumentException("Value must be an instance of Book.");
                }
            
                if ($offset) {
                    $book = $this->findBook($offset);
                    if ($book) {
                        $book->setTitle($value->getTitle());
                        $book->setAuthor($value->getAuthor());
                        $book->setPublicationYear($value->getPublicationYear());
                    } else {
                        $this->addBook($value);
                    }
                } else {
                    $this->addBook($value);
                }
            }
            
            public function offsetUnset($offset)
            {
                $this->removeBook($offset);
            }
            
            public function count()
            {
                return count($this->books);
            }
            
            public function serialize()
            {
                return serialize($this->books);
            }
            
            public function unserialize($serialized)
            {
                $this->books = unserialize($serialized);
            }
            
            }
            $library = new Library();
            $book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 1925, "978-1781396843");
            $book2 = new Book("To Kill a Mockingbird", "Harper Lee", 1960, "978-0446310789");
            $book3 = new Book("1984", "George Orwell", 1949, "978-0451524935");
            
            $library->addBook($book1);
            $library->addBook($book2);
            $library->addBook($book3);
            $library->printBooks();
            
            $book = $library->findBook("978-0446310789");
            if ($book) {
            echo "Found book: " . $book->getTitle() . "<br>";
            } else {
            echo "Book not found." . "<br>";
            }
            
            $clone = $library->cloneBook("978-1781396843");
            if ($clone) {
            echo "Cloned book: " . $clone->getTitle() . "<br>";
            } else {
            echo "Book not found for cloning." . "<br>";
            }
            
            $book4 = new Book("Narnia", "C.S.Lewwis", 1950, "978-1987711222");
            $library["978-1987711222"] = $book4;
            $book = $library["978-0451524935"];
            if ($book) {
            echo "Found book: " . $book->getTitle() . "<br>";
            } else {
            echo "Book not found." . "<br>";
            }
            unset($library["978-1987711222"]);
            echo "Number of books in the library: " . count($library) . "<br>";
            $serialized = serialize($library);
            $unserialized = unserialize($serialized);
            
            echo "Number of books in the unserialized library: " . count($unserialized) . "<br>";
            $unserialized->printBooks();
            $book = $library->findBook("978-1781396843");
            $book = $library->findBook("978-1781396843");
            if ($book) {
            echo "Title: " . $book->getTitle() . "<br>";
            echo "Author: " . $book->getAuthor() . "<br>";
            echo "Publication Year: " . $book->getPublicationYear() . "<br>";
            echo "ISBN: " . $book->getIsbn() . "<br>" . "<br>";
            }
            $library->removeBook("978-1781396843");
            $library->printBooks();
            $clonedBook = $library->cloneBook("978-0451524935");
            if ($clonedBook) {
                echo "Cloned book details: <br>";
                echo "Title: " . $clonedBook->getTitle() . "<br>";
                echo "Author: " . $clonedBook->getAuthor() . "<br>";
                echo "Publication Year: " . $clonedBook->getPublicationYear() . "<br>";
                echo "ISBN: " . $clonedBook->getIsbn() . "<br>" . "<br>";
            }
            $library->printBooks();
            $updatedBook = new Book("1984", "George Orwell", 1949, "978-0451524935");
            $updatedBook->setTitle("Nineteen Eighty-Four");
            $updatedBook->setAuthor("George Orwell");
            $updatedBook->setPublicationYear(1949);
            $library["978-0451524935"] = $updatedBook;
            $library->printBooks();
            echo "Number of books in the library: " . count($library) . "<br>";
            $serializedLibrary = serialize($library);
            $unserializedLibrary = unserialize($serializedLibrary);
            echo "Unserialized library object: <br>";
            $unserializedLibrary->printBooks();