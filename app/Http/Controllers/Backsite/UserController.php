<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\Hash;

// request
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

// use model here
use App\Models\User;
use App\Models\ManagementAccess\DetailUser;
use App\Models\ManagementAccess\TypeUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();
        $type_user = TypeUser::orderBy('name', 'asc')->get();

        return view('pages.management-access.user.index', compact('user', 'type_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // hash password
        $data['password'] = Hash::make($data['password']);

        // store to database
        $user = User::create($data);

        // save to detail user , to set type user
        $detail_user = new DetailUser;
        $detail_user->user_id = $user['id'];
        $detail_user->type_user_id = $request['type_user_id'];
        $detail_user->save();

        alert()->success('Sukses', 'User berhasil ditambahkan');
        return redirect()->route('backsite.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $user = User::find($decrypt_id);

        $type_user = TypeUser::orderBy('name', 'asc')->get();

        return view('pages.management-access.user.edit', compact('user', 'type_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // get all request from frontsite
        $data = $request->all();

        // cek ada update password atau tidak
        if ($request->password != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        // update to database
        $user->update($data);

        // save to detail user , to set type user
        $detail_user = DetailUser::find($user['id']);
        $detail_user->type_user_id = $request['type_user_id'];
        $detail_user->save();

        alert()->success('Sukses', 'User berhasil diupdate');
        return redirect()->route('backsite.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $user = User::find($decrypt_id);

        // hapus user
        $user->forceDelete();

        // Hapus Detail User
        $detail_user = DetailUser::find($user['id']);
        $detail_user->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
