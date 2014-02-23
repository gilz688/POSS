<?php
$I = new WebGuy($scenario);
$I->wantTo('login as admin');
$I->amOnPage('/');
$I->fillField('username', 'admin1');
$I->fillField('password', 'admin1_password');
$I->click('Login');
$I->amOnPage('/profile');