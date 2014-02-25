<?php
use \WebGuy;

class AuthenticationCest
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
    private function resetSession(WebGuy $I){
        $I->amOnPage('/');
        $I->setCookie('laravel_session', '');
        $I->resizeWindow(1366, 768);
    }
    
    public function tryToLoginAsAdmin(WebGuy $I) {
        $this->resetSession($I);
        $I->am('admin');
        $I->wantTo('log in');
        $I->expectTo('see my profile page');
        $I->amOnPage('/');
        $I->fillField('username', 'admin1');
        $I->fillField('password', 'admin1_password');
        $I->click('Login');
        $I->canSeeInCurrentUrl('/profile');
        
        $I->click('Logout');
    }
    
    public function tryToLoginAsAuditor(WebGuy $I) {
        $this->resetSession($I);
        $I->am('auditor');
        $I->wantTo('log in');
        $I->expectTo('see my profile page');
        $I->amOnPage('/');
        $I->fillField('username', 'auditor1');
        $I->fillField('password', 'auditor1_password');
        $I->click('Login');
        $I->canSeeInCurrentUrl('/profile');
        
        $I->click('Logout');
    }
    
    public function tryToLoginAsClerk(WebGuy $I) {
        $this->resetSession($I);
        $I->am('clerk');
        $I->wantTo('log in');
        $I->expectTo('see my profile page');
        $I->amOnPage('/');
        $I->fillField('username', 'clerk1');
        $I->fillField('password', 'clerk1_password');
        $I->click('Login');
        $I->canSeeInCurrentUrl('/profile');
        
        $I->click('Logout');
    }
    
    public function tryToLoginWithWrongPassword(WebGuy $I) {
        $this->resetSession($I);
        $I->am('admin');
        $I->wantTo('login with wrong password');
        $I->expectTo('see error message');
        $I->amOnPage('/');
        $I->fillField('username', 'admin1');
        $I->fillField('password', 'admin1_qwerty');
        $I->click('Login');
        $I->see('Invalid username and/or password.');
    }
    
    public function tryToLoginWithBlankCredentials(WebGuy $I) {
        $this->resetSession($I);
        $I->wantToTest('login with blank credentials');
        $I->expectTo('see error message');
        $I->amOnPage('/');
        $I->fillField('username', '');
        $I->fillField('password', '');
        $I->click('Login');
        $I->see('Invalid username and/or password.');
    }

}