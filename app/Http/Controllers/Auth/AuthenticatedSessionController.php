<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;

class AuthenticatedSessionController extends Controller
{
    protected $redirectTo = '/';
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(session()->has('cart')){
            $carts = session()->get('cart');
            $post = [];
            foreach($carts as $id=>$cart){
                $post[] = array(
                    'user_id' => auth()->user()->id,
                    'product_id' => $id,
                    'quantity' => $cart['quantity'],
                    'mrp' => $cart['mrp'],
                    'total' => $cart['quantity']*$cart['selling_price'],
                    'selling_price' => $cart['selling_price'],
                    'options' => serialize($cart['options']),
                );
            }
            $cart_id = Cart::upsert($post,['user_id','product_id'],['quantity']);

        }
        //echo auth()->user()->id; die();

        return redirect()->intended(RouteServiceProvider::HOME);
        //return redirect()->back();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
