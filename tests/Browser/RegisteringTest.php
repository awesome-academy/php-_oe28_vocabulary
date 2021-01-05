<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class RegisteringTest extends DuskTestCase
{
    public function testRegisteringView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(env('APP_URL') . '/register')
                ->assertSee(trans('auth.register'))
                ->assertPresent('#name')
                ->assertPresent('#email')
                ->assertPresent('#password')
                ->assertPresent('#password-confirm');
        });
    }

    public function testRegisteringSuccessfully()
    {
        $user = factory(User::class)->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                ->type('#name', $user->name)
                ->type('#email', $user->email)
                ->type('#password', $user->password)
                ->type('#password-confirm', $user->password)
                ->click('button[type="submit"]')
                ->assertPathIs('/');
        });
        User::where('email', $user->email)->delete();
    }

    public function testRegisteringFailed()
    {
        $user = factory(User::class)->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                ->type('form #name', $user->name)
                ->type('#email', $user->email)
                ->type('#password', $user->password)
                ->type('#password-confirm', 'test')
                ->click('button[type="submit"]')
                ->assertPathIs('/register');
        });
    }
}
