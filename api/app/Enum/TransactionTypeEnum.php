<?php

namespace App\Enum;

class TransactionTypeEnum
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

    public static function getValues()
    {
        return [
            self::DEBIT => [
                'id' => self::DEBIT,
                'description' => 'Débito',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::BILLET => [
                'id' => self::BILLET,
                'description' => 'Boleto',
                'type' => self::EXPENSE,
                'operator' => '-',
            ],
            self::FINANCING => [
                'id' => self::FINANCING,
                'description' => 'Financiamento',
                'type' => self::EXPENSE,
                'operator' => '-',
            ],
            self::CREDIT => [
                'id' => self::CREDIT,
                'description' => 'Crédito',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::LOAN_INCOME => [
                'id' => self::LOAN_INCOME,
                'description' => 'Recebimento Empréstimo',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::SALES => [
                'id' => self::SALES,
                'description' => 'Vendas',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::TED_INCOME => [
                'id' => self::TED_INCOME,
                'description' => 'Recebimento TED',
                'type' => self::INCOME,
                'operator' => '+',
            ],
            self::DOC_INCOME => [
                'id' => self::DOC_INCOME,
                'description' => 'Recebimento DOC',
                'type' => self::INCOME ,
                'operator' => '+',
            ],
            self::RENT => [
                'id' => self::RENT,
                'description' => 'Aluguel',
                'type' => self::EXPENSE,
                'operator' => '-',
            ],
        ];
    }
}
