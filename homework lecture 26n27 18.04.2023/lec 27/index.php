<html>
<body>
<?php
interface Product {
    public function getName();
    public function getPrice();
    public function getDescription();
    public function getImage();
}
class ConcreteProduct implements Product {
    private $name;
    private $price;
    private $description;
    private $image;
    public function __construct($name, $price, $description, $image) {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getImage() {
        return $this->image;
    }
}
final class ShoppingCart {
    private static $items = array();

    private function __construct() {
    }
    public static function addItem(Product $product, $quantity) {
        self::$items[] = array(
            'product' => $product,
            'quantity' => $quantity
        );
    }
    public static function removeItem($index) {
        unset(self::$items[$index]);
        self::$items = array_values(self::$items);
    }
    public static function getItems() {
        return self::$items;
    }
    public static function getTotal() {
        $total = 0;
        foreach (self::$items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }
}
abstract class PaymentMethod {
    abstract public function processPayment(float $amount): bool;
}
class CreditCardPayment extends PaymentMethod {
    private $cardNumber;
    private $expirationDate;
    private $cvv;
    public function __construct(string $cardNumber, string $expirationDate, string $cvv) {
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate; 
        $this->cvv = $cvv;
    }
    public function processPayment(float $amount): bool {
        return true;
    }
}
interface PaymentMethodInterface {
    public function processPayment(float $amount): bool;
}
abstract class AbstractPaymentMethod implements PaymentMethodInterface {
    protected $paymentType;

    public function __construct(string $paymentType) {
        $this->paymentType = $paymentType;
    }
}
class PaypalPayment extends AbstractPaymentMethod {
    private $email;
    private $password;

    public function __construct(string $paymentType, string $email, string $password) {
        parent::__construct($paymentType);
        $this->email = $email;
        $this->password = $password;
    }
    public function processPayment(float $amount): bool {
        return true;
    }
}
class BankTransferPayment extends AbstractPaymentMethod {
    private $accountNumber;
    private $routingNumber;

    public function __construct(string $paymentType, string $accountNumber, string $routingNumber) {
        parent::__construct($paymentType);
        $this->accountNumber = $accountNumber;
        $this->routingNumber = $routingNumber;
    }

    public function processPayment(float $amount): bool {
        return true;
    }
}
abstract class AbstractProduct {
    protected $name;
    protected $price;
    protected $description;
    protected $image;
    public function __construct($name, $price, $description, $image) {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getImage() {
        return $this->image;
    }
    }
    class BookProduct extends AbstractProduct {
    private $author;
    private $pages;
    public function __construct($name, $price, $description, $image, $author, $pages) {
      parent::__construct($name, $price, $description, $image);
      $this->author = $author;
      $this->pages = $pages;
  }
  public function getAuthor() {
      return $this->author;
  }
  public function getPages() {
      return $this->pages;
  }
  }
  class ClothingProduct extends AbstractProduct {
  private $size;
  private $color;
  public function __construct($name, $price, $description, $image, $size, $color) {
    parent::__construct($name, $price, $description, $image);
    $this->size = $size;
    $this->color = $color;
}
public function getSize() {
    return $this->size;
}
public function getColor() {
    return $this->color;
}
}
$bookProduct = new BookProduct('The Lord of the Rings', 20.99, 'Epic fantasy novel', 'https://example.com/books/lotr.jpg', 'J.R.R. Tolkien', 1178);
$clothingProduct = new ClothingProduct('T-Shirt', 10.99, 'Comfortable cotton t-shirt', 'https://example.com/clothing/tshirt.jpg', 'M', 'Black');
ShoppingCart::addItem($bookProduct, 2);
ShoppingCart::addItem($clothingProduct, 3);
$paymentMethod = new PaypalPayment('Paypal', 'example@example.com', 'password');
if ($paymentMethod->processPayment(ShoppingCart::getTotal())) {
echo "Payment successful!";
} else {
echo "Payment failed!";
}
?>
</body>
</html>