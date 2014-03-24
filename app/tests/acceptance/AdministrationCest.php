<?php
use \WebGuy;

class AdministrationCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }
    
     /*
     *  Reset Laravel Session
     */
    private function loginAsAdmin(WebGuy $I){
        $I->amOnPage('/');
        $I->setCookie('laravel_session', '');
        $I->reloadPage();
        $I->fillField('username', 'admin1');
        $I->fillField('password', 'admin1_password');
        $I->click('LOGIN');
        $I->resizeWindow(1366, 768);
    }
    
    public function tryToAddUser(WebGuy $I) {
        $I->am('admin');
        $I->wantTo('add user');
        $this->loginAsAdmin($I);
        $I->click('Users');
        $I->cantSee('clerk3');
        $I->click('ADD USER');
        $I->fillField('username', 'clerk3');
        $I->fillField('password', 'clerk3_password');
        $I->fillField('confirm', 'clerk3_password');
        $I->selectOption('role', 'Clerk');
        $I->click('ADD');
        $I->canSeeInCurrentUrl('/users');
        $I->canSee('clerk3');
    }
}