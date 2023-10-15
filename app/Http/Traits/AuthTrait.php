<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

trait AuthTrait
{
    public function checkGaurd(Request $request){

        if ($request->type=='student'){
            $gaurdName='student';
        }
        elseif($request->type=='parent'){
            $gaurdName='parent';
        }
        elseif($request->type=='teacher'){
            $gaurdName='teacher';
        } else {
            $gaurdName='web';
        }
        return $gaurdName;
    }

    public function redirect(Request $request)
    {
        if ($request->type=='student'){
            return redirect()->intended(RouteServiceProvider::STUDENT);
        }
        elseif($request->type=='parent'){
            return redirect()->intended(RouteServiceProvider::PARENT);
        }
        elseif($request->type=='teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);
        }
        else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
