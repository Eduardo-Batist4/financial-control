<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionTest extends TestCase
{
    protected User $user;
    protected Category $category;

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    public function test_must_return_all_transactions(): void
    {
        $token = JWTAuth::fromUser($this->user);        

        Transaction::factory()
            ->count(5)
            ->create([
                'user_id' => $this->user->id,
                'category_id' => $this->category->id,
                'account_id' => $this->user->account->id
            ]);        

        $this->get('/api/transactions',[
            'Authorization' => "Bearer $token"
        ])
        ->assertStatus(200)
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'type',
                    'amount',
                    'description',
                    'date',
                    'category' => [
                        'id',
                        'name'
                    ]
                ]
            ]
        ]);
    }

    public function test_must_return_the_statistcs_of_all_transactions(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $categories = $this->user->categories()->createMany([
            ['name' => 'Poatan'],
            ['name' => 'jjj']
        ]);

        $this->user->transactions()->createMany([
            [
                'name' => 'Mac Donalds',
                'category_id' => $categories[0]->id,
                'account_id' => $this->user->account->id,
                'type' => 'output',
                'amount' => 500,
                'date' => '2025-09-14',
            ],
            [
                'name' => 'Chair',
                'category_id' => $categories[0]->id,
                'account_id' => $this->user->account->id,
                'type' => 'output',
                'amount' => 645,
                'date' => '2025-09-03',
            ],
            [
                'name' => 'Window',
                'category_id' => $categories[0]->id,
                'account_id' => $this->user->account->id,
                'type' => 'output',
                'amount' => 132.99,
                'date' => '2025-09-22',
            ],
            [
                'name' => 'Door',
                'category_id' => $categories[0]->id,
                'account_id' => $this->user->account->id,
                'type' => 'output',
                'amount' => 879.50,
                'date' => '2025-09-25',
            ],
            [
                'name' => 'Mouse Logitech',
                'category_id' => $categories[1]->id,
                'account_id' => $this->user->account->id,
                'type' => 'output',
                'amount' => 200,
                'date' => '2025-09-16',
            ], 
        ]);
        
        $this->get('/api/transactions/stats', [
            'Authorization' => "Bearer $token"
        ])
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment([
            'data' => [
                [
                    'category_id' => $categories[0]->id,
                    'category_name' => 'Poatan',
                    'total' => 2157.49,
                    'average' => 92
                ],
                [
                    'category_id' => $categories[1]->id,
                    'category_name' => 'jjj',
                    'total' => 200,
                    'average' => 8
                ]
            ]
            ]);
    }

    public function test_must_create_a_new_transaction_with_type_input(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $payload = [            
            'name' => 'Test-02',
            'category_id' => $this->category->id,
            'type' => 'input',
            'amount' => 719.99,
            'description' => 'descrição',
            'date' => '2025-09-08', 
        ];

        $this->post('/api/transactions', $payload, [
            'Authorization' => "Bearer $token",
        ])
        ->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'Test-02',
            'type' => 'input',
            'amount' => 719.99,
            'description' => 'descrição', 
            'date' => '2025-09-08',
        ]);

        $current_balance = Account::DEFAULT_BALANCE;
        $this->assertDatabaseHas('accounts', [
            'id' => $this->user->account->id,
            'balance' => $current_balance,
            'current_balance' => $current_balance + $payload['amount'],
        ]);
    }

    public function test_must_create_a_new_transaction_with_type_output(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $payload = [            
            "name" => "Test-03",
            "category_id" => $this->category->id,
            "type" => "output",
            "amount" => 300.00,
            "date" => "2025-09-08", 
        ];

        $this->post('/api/transactions', $payload, [
            'Authorization' => "Bearer $token",
        ])
        ->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'Test-03',
            'type' => 'output',
            'amount' => 300.00,
            'description' => null, 
            'date' => '2025-09-08',
        ]);

        $current_balance = Account::DEFAULT_BALANCE;
        $this->assertDatabaseHas('accounts', [
            'id' => $this->user->account->id,
            'balance' => $current_balance,
            'current_balance' => $current_balance - $payload['amount'],
        ]);
    }

    public function test_must_update_a_transaction(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $transaction = Transaction::create([
            'name' => 'Test-04',
            'category_id' => $this->category->id,
            'user_id' => $this->user->id,
            'type' => 'output',
            'amount' => 500.90,
            'date' => '2025-09-20',
            'account_id' => $this->user->account->id
        ]);

        $newCategory = Category::factory()->create(['id' => 3]);

        $payload = [
            'name' => 'Test-04 updated',
            'category_id' => $newCategory->id,
            'type' => 'output',
            'amount' => 499.99,
            'date' => '2025-09-18', 
        ];

        $this->put("/api/transactions/{$transaction->id}", $payload, [
            'Authorization' => "Bearer $token",
        ])
        ->assertStatus(200)
        ->assertJsonFragment([   
            'name' => 'Test-04 updated',
            'type' => 'output',
            'amount' => 499.99,
            'description' => null, 
            'date' => '2025-09-18',
        ]);
    }

    public function test_must_delete_a_transaction(): void
    {
        $token = JWTAuth::fromUser($this->user);

        $transaction = Transaction::create([
            'name' => 'Test-05',
            'category_id' => $this->category->id,
            'user_id' => $this->user->id,
            'type' => 'output',
            'amount' => 500.90,
            'date' => '2025-09-20',
            'account_id' => $this->user->account->id
        ]);

        $this->delete("/api/transactions/{$transaction->id}", [], [
            'Authorization' => "Bearer $token",
        ])->assertNoContent();
    }
}
