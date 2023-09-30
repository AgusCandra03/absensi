<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function api()
    {
        $users = User::all();

        $datatables = datatables()->of($users)
        ->addColumn('date',function($row) {
            return convert_date($row->created_at);
        })
        ->addIndexColumn();

        return $datatables->make(true);
    }
    
    public function editProfile()
    {
        // $users = User::all();
        return view('auth.edit-profile');
        // return  $users;
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request,[
            'name'=> 'required',
            'email'  => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $input = $request->all();
        $input['name'] = $request['name'];
        $input['email'] = $request['email'];
        $input['password'] = Hash::make($request['password']);

        // $user->update($request->all());
        $user->update($input);
        return redirect('edit-profile');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email'  => 'required',
            'password'  => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('employees');
    }

    public function spatie()
    {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'input user']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $user = auth()->user();
        // $user->assignRole('admin');
        // return $user;

        $user = User::with('roles')->get();
        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
