<?php

namespace ATPGroup\Users\Controllers;

use App\Http\Controllers\Controller;
use ATPGroup\Users\Models\User;
use ATPGroup\Users\Requests\StoreUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = User::when(auth()->check() && auth()->user()->role->is_super == false, function($query){
            $user = auth()->user();
            $query->where('company_id', (int) $user->company_id);
            if($user->branch_id)
            {
                $query->where('branch_id', (int) $user->branch_id);
            }
        })->search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('user::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user::create')->with('user', new User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->save();
        return redirect()->route('user.index')->with('success', __('user::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        return view('user::edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return redirect()->route('user.index')->with('success', __('user::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['status' => 'ok', 'message' => __('user::language.message.deleted')]);
    }

    /**
     * Profile the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();
        return view('user::profile')->with('user', $user);
    }

    /**
     * Update Profile the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(StoreUserRequest $request)
    {
        $user = User::find(auth()->id());
        $user->fill($request->all());
        $user->save();
        return redirect()->back()->with('success', __('user::language.message.updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function activated(Request $request, User $user)
    {
        if ($user->is_active == 0) {
            $user->update(['is_active' => 1]);
        } else {
            $user->update(['is_active' => 0]);
        }

        return response()->json(['status' => 'ok', 'message' => __('user::language.message.updated')]);
    }

}
