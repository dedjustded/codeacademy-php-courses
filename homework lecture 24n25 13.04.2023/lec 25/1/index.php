<?php
class Currency
{
    private $symbol;
    private $exchangeRate;

    public function __construct($symbol, $exchangeRate)
    {
        $this->symbol = $symbol;
        $this->exchangeRate = $exchangeRate;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }
}

class Calculator
{
    private $fromCurrency;
    private $toCurrency;

    public function __construct(Currency $fromCurrency, Currency $toCurrency)
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
    }

    public function convert($amount)
    {
        $convertedAmount = $amount * $this->fromCurrency->getExchangeRate() / $this->toCurrency->getExchangeRate();
        return $this->toCurrency->getSymbol() . number_format($convertedAmount, 2);
    }
}

$bgn = new Currency('BGN', 1);
$usd = new Currency('USD', 1.65);
$eur = new Currency('EUR', 1.95);

if(isset($_POST['submit'])) {
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];

    switch($currency) {
        case 'BGN':
            $fromCurrency = $bgn;
            break;
        case 'USD':
            $fromCurrency = $usd;
            break;
        case 'EUR':
            $fromCurrency = $eur;
            break;
        default:
            $fromCurrency = $bgn;
    }

    $toCurrency = $eur;
    $calculator = new Calculator($fromCurrency, $toCurrency);
    $result = $calculator->convert($amount);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
</head>
<body>
    <form method="post">
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">
        <label for="currency">From:</label>
        <select name="currency" id="currency">
        <option value="BGN">BGN</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
    </select>

    <label for="toCurrency">To:</label>
    <select name="toCurrency" id="toCurrency">
        <option value="BGN">BGN</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
    </select>

    <input type="submit" name="submit" value="Convert">
</form>

<?php if(isset($result)): ?>
    <p><?php echo $result; ?></p>
<?php endif; ?>

</body>
</html>
