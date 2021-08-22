<?php

namespace App\Enum;

class Transaction
{
    public const DEBIT = 1;
    public const BILLET = 2;
    public const FINANCING = 3;
    public const CREDIT = 4;
    public const LOAN_INCOME = 5;
    public const SALES = 6;
    public const TED_INCOME = 7;
    public const DOC_INCOME = 8;
    public const RENT = 9;

    public const INCOME = 'income';
    public const EXPENSE = 'expense';

    public function getValues()
    {
        return [
            self::DEBIT => [
                'description' => 'Débito',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::BILLET => [
                'description' => 'Boleto',
                'type' => self::EXPENSE,
                'operator' => '-',
            ],
            self::FINANCING => [
                'description' => 'Financiamento',
                'type' => self::EXPENSE,
                'operator' => '-',
            ],
            self::CREDIT => [
                'description' => 'Crédito',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::LOAN_INCOME => [
                'description' => 'Recebimento Empréstimo',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::SALES => [
                'description' => 'Vendas',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::TED_INCOME => [
                'description' => 'Recebimento TED',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::DOC_INCOME => [
                'description' => 'Recebimento DOC',
                'type' => self::INCOME ,
                'operator' => '+',
            ],
            self::RENT => [
                'description' => 'Aluguel',
                'type' => self::EXPENSE,
                'operator' => '-',
            ],
        ];
    }
}
