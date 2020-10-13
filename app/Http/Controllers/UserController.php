<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('users.user');
    }
    public function users(){
        $users = User::where('type','!=',1)
            ->orderByDesc('created_at')
            ->paginate(15);
        return response($users,200);
    }
    public function show(User $model)
    {
        return view('users.index', ['users' => $model]);
    }
    public function search($search){

        $users= User::where('name','LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orderByDesc('updated_at')
            ->paginate(15);

        return response($users,200);
    }
    public function destroy(User $user)
    {
        $result=$user->delete();
        return response()->json($result,200);
    }
    public function update(Request $request,User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|'. Rule::unique('users')->ignore($user->id),
        ]);

        // Fill user model
        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Save user to database
        $user->save();
        return response()->json($user,200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|unique:users',
        ]);


        // Fill user model
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type'=>2,
            'password'=>Hash::make('12345678')
        ]);

        // Save user to database
        return response()->json($user,200);
    }
}
