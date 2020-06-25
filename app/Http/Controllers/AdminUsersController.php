<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //used for showing form to create a user
        //passed role name and id as an array to view
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    //created my manual UsersRequest for validation purposes
    public function store(UsersRequest $request)
    {
        if(trim($request->password) == '')
        {
            $input = $request->except('password');
        }
        else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        //gets form data and save it,
        //User::create($request->all());
        //and then goes to show all users
        //return redirect('/admin/users');
        //$input = $request->all();
        if($file = $request->file('photo_id'));
        {
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        User::create($input);
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //finding specific user and showing it in edit view
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if(trim($request->password) == '')
        {
            $input = $request->except('password');
        }
        else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
       // $input = $request->all();
        if($file = $request->file('photo_id'));
        {
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //deletes user without image file
        //User::findOrFail($id)->delete();
        $user = User::findOrFail($id);
        //to delete the image file from public/images folder
        unlink(public_path().$user->photo->file);
        $user->delete();
        Session::flash('deleted_user','User has been successfully deleted');
      return redirect('/admin/users');
    }
}
