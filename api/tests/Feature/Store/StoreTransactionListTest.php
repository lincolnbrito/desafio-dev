<?php

namespace Tests\Feature\Store;

use App\Models\Store;
use App\Services\CnabImporterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTransactionListTest extends TestCase
{
    use RefreshDatabase;
    protected $service;

    public function setUp(): void
    {
        $this->service = app(CnabImporterService::class);
        parent::setUp();
    }

    /**
     * @dataProvider provideTransactions
     */
    public function test_it_should_list_only_store_transactions(
        $storeId,
        $expectedBalance,
        $expectedTransactionTotal,
        $expectedTransactionCount
    ): void
    {
        $this->seed();
        $arrayLines = file($this->getFixtureDir()."/CNAB.txt", FILE_IGNORE_NEW_LINES );
        $this->service->import($arrayLines);

        $store = Store::find($storeId);
        $response = $this->get(route('api.stores.transactions.index', ['store' => $store->id]))
            ->assertStatus(200)
            ->assertJsonCount($expectedTransactionCount, 'data');

        $sumTransactions = collect($response->json('data'))->sum(function($item){
            return $item['type']['operator'] ==='+' ? $item['amount'] : -$item['amount'];
        });

        $this->assertEquals( (float)$sumTransactions, $expectedTransactionTotal);
        $this->assertEquals( $expectedBalance, (float)$store->balance);
    }

    public function provideTransactions()
    {
        return [
            'bar-do-joao' => [
                'id' => 1,
                'balance' => -102.00,
                'sumTransactions' => -102.00,
                'transactionsCount' => 3
            ],
            'loja-do-o-matriz' => [
                'id' => 2,
                'balance' => 230.0,
                'sumTransactions' => 230.0,
                'transactionsCount' => 3
            ],
            'mercado-da-avenida' => [
                'id' => 3,
                'balance' => 489.20,
                'sumTransactions' => 489.20,
                'transactionsCount' => 8
            ]
        ];
    }
}
