<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->company_id != auth()->user()->company_id)
            abort(403);
        return View::make('User.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if($user->company_id != auth()->user()->company_id)
            abort(403);
        return View::make('User.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function update(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);
            if($user->company_id != auth()->user()->company_id)
                abort(403);
            $user->update($this->validateRequest());

            Session::flash('message', 'Data Base Update Successfully.');
            return View::make('User.profile.show', compact('user'));
        }catch(Exception $e){
            Session::flash('alert', 'There Is Problem, Update Aborted.');
            return View::make('User.profile.edit', compact('user'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function destroy($id)
    {
        $authUser = auth()->user();
        $user = User::findOrFail($id);
        if($user->company_id != $authUser->company_id)
            abort(403);
        $user->delete();
        Session::flash('alert', 'Staff Deleted From Data Base');

        $users = User::where('company_id', '=', $authUser->company_id)
            ->where('id', '<>', auth()->user()->id)
            ->get();
        return View::make('User.user.index', compact('users'));
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|string|min:3|max:255',
            'lastName' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|string'
            ]);
    }

}
