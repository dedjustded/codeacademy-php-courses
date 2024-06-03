<?php
class BankAccount
{
    private $accountNumber;
    private $balance;
    private $interestRate;

    public function deposit($amount)
    {
        $this->balance += $amount;
    }

    public function withdraw($amount)
    {
        if ($amount > $this->balance) {
            throw new Exception("Insufficient funds.");
        }

        $this->balance -= $amount;
    }

    public function calculateInterest()
{
    return $this->balance * $this->interestRate / 100;
}
}
?>
