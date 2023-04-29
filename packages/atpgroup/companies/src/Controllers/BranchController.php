<?php

namespace ATPGroup\Companies\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Companies\Models\Company;
use ATPGroup\Companies\Requests\StoreBranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Company::notParent()->when($request->company_id, function($query) use($request){
            return $query->where('parent_id', $request->company_id);
        })->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('company::branch.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company::branch.create')->with('branch', new Company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        $branch = new Company;
        $branch->save();
        return redirect()->route('branch.index')->with('success', __('company::language.branch.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Companies\Models\Company  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Company $branch)
    {
        return view('company::branch.edit')->with('branch', $branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Companies\Models\Company  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBranchRequest $request, Company $branch)
    {
        $branch->save();
        return redirect()->route('branch.index')->with('success', __('company::language.branch.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $branch)
    {
        $branch->delete();
        return response()->json(['status' => 'ok', 'message' => __('company::language.branch.message.deleted')]);
    }

    /**
     * Display a listing of Branches the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBranches(Request $request)
    {
        $result = Company::where('parent_id', $request->company_id)->get()->map(function ($item) {
            return ['id' => $item->id, 'text' => $item->name];
        });

        return response()->json(['status' => 'ok', 'data' => $result]);
    }
}
