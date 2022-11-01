<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
Use App\Models\Account;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_new_account_zero_balance()
    {
        $account = new Account();

        $balance = $account -> getBalance(); //Se verifica que la cuenta esté creada

        $this->assertTrue($balance == 0, 'mensaje 1');

        $this->assertEquals(0, $balance, 'mensaje 2');

    }

    public function test_deposit_when_incorrect_value()
    {
        $account = new Account();

        $balanceOld = $account -> getBalance();
        $control = $account -> deposit(0);
        $balanceNew = $account -> getBalance();

        // $control = false
        //$balance old == $balance new

        $this->assertFalse($control);

        $this->assertEquals($balanceNew, $balanceOld);

        //Nueva prueba cuando saldo = -100
        $account = new Account();

        $balanceOld = $account -> getBalance();
        $control = $account -> deposit(-100);
        $balanceNew = $account -> getBalance();

        // $control = false
        //$balance old == $balance new

        $this->assertFalse($control);

        $this->assertEquals($balanceNew, $balanceOld);

    }

    public function test_deposit()
    {
        $account = new Account();
        $value = 1000; //Value to deposit

        $balanceOld = $account -> getBalance();
        $control = $account -> deposit($value);
        $balanceNew = $account -> getBalance();

        // $control = false
        //$balance old == $balance new

        $this->assertTrue($control);

        $this->assertEquals($balanceNew, $balanceOld + $value);

    }

    /* public function test_withdraw_without_balance(){

        $account = new Account();

        $value = 1000;
        $withdrawValue = 400;

        $balanceOld = $account -> getBalance();
        $control = $account -> deposit($value);
        $balanceNew = $account -> getBalance();


        $this->assertTrue($control);
        $this->assertEquals($balanceNew - $withdrawValue, $balanceOld);

    } */


}
