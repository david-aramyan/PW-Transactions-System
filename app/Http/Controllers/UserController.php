<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Show the list of all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->where('role_id', 2)->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user edit fotm.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user details.
     *
     * @param  UserUpdateRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        if($request->has('password')){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        \Session::flash('message', 'The user has been updated successfully!');
        return redirect('/admin/users');
    }

    /**
     * Make the user banned.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        \Session::flash('message', 'The user has been banned successfully!');
        return redirect('/admin/users');
    }

    /**
     * Restore the user.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        User::withTrashed()->where('id', $id)->restore();
        \Session::flash('message', 'The user has been restored successfully!');
        return redirect('/admin/users');
    }

    /**
     * Get the current balance of authenticated user
     *
     * @return string
     */
    public function getBalance(){
        return auth()->user()->balance;
    }
}
