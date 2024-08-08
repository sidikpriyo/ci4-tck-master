<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function __construct()
    {
        helper('auth');
    }

    public function index(): string
    {
        return view('pages/home');
    }

    public function tester()
    {

        dd(
            logged_in(),
            user(),
            user_id(),
            ['superadmin' => in_groups('superadmin')],
            ['dekanat' => in_groups('dekanat')],
            ['pimpinan' => in_groups('pimpinan')],
            ['enumerator' => in_groups('enumerator')],
            has_permission('can_view_user'),
            has_permission('can_create_user'),
            has_permission('can_update_user'),
            has_permission('can_delete_user'),

        );
    }
}
