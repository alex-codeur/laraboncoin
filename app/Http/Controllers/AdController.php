<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        $ads = DB::table('ads')->orderBy('created_at', 'DESC')->paginate(3);

        return view('ads', compact('ads'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:ads'],
            'description' => 'required',
            'localisation' => ['required'],
            'price' => ['numeric', 'required']
        ]);

        if(!Auth::check()) {
            $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);

            $this->guard()->login($user);
        }

        $ad = new Ad();
        $ad->title = $data['title'];
        $ad->description = $data['description'];
        $ad->price = $data['price'];
        $ad->localisation = $data['localisation'];
        $ad->user_id = auth()->user()->id;
        $ad->save();

        return redirect()->route('welcome')->with('success', 'Votre annonce a été postée.');
    }

    public function search(Request $request)
    {
        $words = $request->words;

        $ads = DB::table('ads')
                ->where('title', 'LIKE', '%$words%')
                ->orWhere('description', 'LIKE', '%$words%')
                ->orderBy('created_at', 'DESC')
                ->get();
        
        return response()->json(['success' => true, 'ads' => $ads]);
    }
}
