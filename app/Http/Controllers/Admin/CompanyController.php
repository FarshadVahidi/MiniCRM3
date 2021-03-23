<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $companies = Company::where('id', '<>', auth()->user()->company_id)
                                ->get();
        return View::make('Admin.company.index', compact('companies'));
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
    public function show($id)
    {
        if($id != auth()->user()->company_id)
            abort(403);

        $company = Company::findOrFail($id);
        return View::make('Admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Company $company)
    {
        $user = auth()->user();
        if($user->company_id != $company->id)
            abort(403);
        return View::make('Admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function update(Request $request, Company $company)
    {
        try{
            $company->update($this->validateRequest());
            $this->storeImage($company);

            Session::flash('message', 'Data Base Successfully Updated.');
            return View::make('User.company.edit', compact('company'));
        }catch(Exception $e){
            Session::flash('alert', 'There Is Problem, Update Aborted.');
            return View::make('User.company.edit', compact('company'));
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
            'name'  => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'website'   => ['required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ]), function (){
            if(request()->hasFile('photo')){
                if(request()->hasFile('photo')){
                    request()->validate([
                        'photo' => 'file|image|max:5000'
                    ]);
                }
            }
        });
    }

    //STILL THE SAME ERROR!!!
    private function storeImage($company)
    {
        if(request()->hasFile('photo'))
        {
            $company->update([
                'photo'  => request()->photo->store('uploads', 'public'),
            ]);
        }
    }
}
