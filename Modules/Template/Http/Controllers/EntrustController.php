<?php

namespace Modules\Template\Http\Controllers;

use Modules\Entrust\Http\Requests\LoginPost;

class EntrustController extends \Modules\Entrust\Http\Controllers\EntrustController
{
    public function login(LoginPost $request)
    {
        $data = parent::login($request)->getData('data');
        if ($data['data']) {
            return redirect('/');
        }
        return redirect('/');
    }

    public function logout()
    {
        $data = parent::logout()->getData('data');
        if ($data['data']) {
            return redirect('/');
        }
        return redirect('/');
    }
}
