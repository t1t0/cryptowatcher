<?php

namespace App;

interface CryptoApiRepositoryInterface
{
    public function listLatestCoins(string $sort, string $currencyType);

    public function getLatestCoinQuote(string $symbol, string $currency);
}
