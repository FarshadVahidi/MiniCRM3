<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return View::make('Admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return View::make('Admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function update(Request $request, User $user)
    {
        try{
            $user->update($this->validateRequest());
            $this->storeImage($user);

            Session::flash('message', 'Data Base Successfully Updated.');
            return View::make('Admin.user.edit', compact('user'));
        }catch(Exception $e){
            Session::flash('alert', 'There Is Problem, Update Aborted.');
            return View::make('Admin.user.edit', compact('user'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateRequest()
    {
        return tap(request()->validate([
            'name'      =>  'required|string|min:3|max:255',
            'lastName'  =>  'required|string|min:3|max:255',
            'email'     =>  'required|email',
            'phone'     =>  'required|string'
        ]), function(){
            if(request()->hasFile('photo'))
            {
                request()->validate([
                    'photo' => 'file|image|max:2048'
                ]);
            }
        });
    }

    //I CAN NOT UNDERSTAND THIS SHOULD WORK PROPERLY BUT IN DATABASE ADD PREFIX UPLOADS/... TO MY IMGE NAME AND IN SHOW.BLADE I CAN NOT SEE IT
    private function storeImage($user)
    {
        if(request()->hasFile('photo'))
        {
            $user->update([
                'photo' => request()->photo->store('public/image'),
            ]);
        }
    }
}
