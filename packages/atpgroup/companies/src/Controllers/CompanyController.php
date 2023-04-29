<?php

namespace ATPGroup\Companies\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Companies\Models\Company;
use ATPGroup\Companies\Requests\StoreCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Company::parent()->search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('company::company.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company::company.create')->with('company', new Company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new Company;
        $company->save();
        return redirect()->route('company.index')->with('success', __('company::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Companies\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Company $company)
    {
        return view('company::company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Companies\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $company->save();
        return redirect()->route('company.index')->with('success', __('company::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['status' => 'ok', 'message' => __('company::language.message.deleted')]);
    }

}
