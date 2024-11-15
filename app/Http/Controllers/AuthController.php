<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Crypt;
use Input;
use Response;
use OneSignal;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests;
use App\Models\Branch;
use App\Models\ApiUser;
use App\Models\Company;
use App\Models\RoleUser;
use App\Models\Permission;
use App\Models\UserStatus;
use Illuminate\Support\Str;
use App\Models\Intermediary;
use Illuminate\Http\Request;
use App\Models\UnderwriterLimits;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1
    use ThrottlesLogins;





    public function getSignup()
    {
        $roles = Role::get();
        $company = Company::get()->first();
        $branches = Branch::orderby('branch_name', 'asc')->get();
        $intermediaries = Intermediary::orderby('agentname', 'asc')->get();
        return view('auth.signup', compact('roles', 'branches', 'intermediaries'));
    }

    public function getUserEdit($id)
    {
        $id = Crypt::decrypt($id);

        $company = Company::get()->first();
        $user = User::where('id', $id)->first();
        $roles = Role::get();
        $status = UserStatus::get();
        $branches = Branch::orderby('branch_name', 'asc')->get();

        return view('auth.edituser', compact('user', 'roles', 'company','status','branches'));
    }

    public function chat()
    {

        return view('auth.chat');
    }


    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|min:2',
            'username' => 'required|max:100',
            'password' => 'same:password_confirmation',
            'password_confirmation' => '',
            'fullname' => 'required|min:3',
            'location' => 'required|min:2',
            'usertype' => 'required|min:2',
        ]);

        $user = User::where('id', $request->get('userid'))->first();
        $password = $request->get('password');

        $affectedRows = User::where('id', $request->get('userid'))->update(
            array(
                'password' => isset($password) ? bcrypt($password) : $user->password,
                'username' => $request->get('username'),
                'phone_number' => $request->get('phone_number'),
                'assigned_agent' => $request->get('agency'),
                'location' => $request->get('location'),
                'usertype' => $request->get('usertype'),
                'fullname' => $request->get('fullname'),
                'status' => $request->get('status')
            )
        );

        //update password security
        if (isset($password)) {
            $user->passwordSecurity->password_updated_at = \Carbon\Carbon::now();
            $user->passwordSecurity->save();
        }

        //delete previous role
        $lastRole = \DB::table('role_user')->where('user_id', $request->get('userid'))->first();

        //dd($lastRole);

        $role = Role::where('name', $request->get('usertype'))->first();

        if ($lastRole) {
            if ($role->id != $lastRole->role_id) {
                \DB::table('role_user')->where('user_id', $request->get('userid'))->delete();

                $user->attachRole($role);
            }
        }

        if ($affectedRows > 0) {
            return redirect()
                ->route('manage-users')
                ->with('info', 'User has been updated successfully!');
        } else {
            return redirect()
                ->route('manage-users')
                ->with('Warning', 'User details failed to update');
        }
    }

    public function resetPassword(Request $request)
    {
        if(Auth::user()->hasPermission('edit-user')){
            if($request->input('password') == '')
            {

            $this->validate($request, [
                'phone_number'=> 'required|min:2',
                'username'=> 'required|max:100',
                'fullname'=> 'required|min:3',
                'usertype'=> 'required|min:2',
                'status'=> 'required|min:2'
            ]);

            if($request->input('status') == 'Blocked' ){
                $affectedRows = User::where('id', $request->input('userid'))->update(array(
                    'username'=> $request->input('username'),
                    'usertype' => $request->input('usertype'),
                    'status' => $request->input('status'), 
                    'fullname' => $request->input('fullname'),
                   ));
            }else{
                $affectedRows = User::where('id', $request->input('userid'))->update(array(
                    'username'=> $request->input('username'),
                    'usertype' => $request->input('usertype'),
                    'status' => $request->input('status'), 
                    'fullname' => $request->input('fullname')));
            }
        
        
            }else{
    
            $this->validate($request, [
                'phone_number'=> 'required|min:2',
                'username'=> 'required|max:100',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
                'usertype'=> 'required|min:2',
                'status'=> 'required|min:2'
            ]);


            $affectedRows = User::where('id', $request->input('userid'))->update(array('password' =>  bcrypt($request->input('password')),'username'=> $request->input('username') , 'usertype' => $request->input('usertype'),'status' => $request->input('status'), 'fullname' => $request->input('fullname')));
        
            }
        }else{
            if($request->input('password') == '')
            {
            $this->validate($request, [
                    'phone_number'=> 'required|min:2',
                    'username'=> 'required|max:100',
                    'fullname'=> 'required|min:3',
                    'usertype'=> 'required|min:2',
                    'status'=> 'required|min:2'
            ]);

            if($request->input('status') == 'Blocked' ){
                $affectedRows = User::where('id', $request->input('userid'))->update(array(
                    'username'=> $request->input('username'),
                    'email'=> $request->input('email'),
                    'assigned_agent' => $request->get('assigned_agent'), 
                    'fullname' => $request->input('fullname'),
                    'status'=> $request->input('status')));
            }else{

                    $affectedRows = User::where('id', $request->input('userid'))->update(array(
                        'username'=> $request->input('username'),
                        'email'=> $request->input('email'),
                        'assigned_agent' => $request->get('assigned_agent'), 
                        'fullname' => $request->input('fullname')));
            }
        
        
            }else{
        

            $this->validate($request, [
                'phone_number'=> 'required|min:2',
                'username'=> 'required|max:100',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
            ]);


            $affectedRows = User::where('id', $request->input('userid'))->update(array(
                'password' =>  bcrypt($request->input('password')),
                'username'=> $request->input('username'),
                'phone_number'=> $request->input('phone_number'),
                'assigned_agent' => $request->get('assigned_agent'), 
                'fullname' => $request->input('fullname')));
        
            }
            }

            $role = Role::where('name', $request->get('usertype'))->first();
            $affectedRows2 = RoleUser::where('user_id', $request->input('userid'))->update(array('role_id' => $role->id  ));

            if($affectedRows > 0)
            {
            
                return redirect()
            ->route('manage-users')
            ->with('info','Password has successfully been updated!, User can now sign in');
            }
            else
            {
                return redirect()
            ->route('manage-users')
            ->with('Warning','User details failed to update');
            }

    }


    public function postSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|unique:users|min:2',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
            'fullname' => 'required|min:3',
            'location' => 'required|min:2',
            'usertype' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('manage-users')
                ->with('error', 'Account failed to create. Kindly ensure email and username is unique and passwords match');
        }

        $assigned_role = $request->input('usertype');

        $user = new User;
        
        $user->username = strtolower($request->input('username'));
        $user->password = bcrypt($request->input('password'));
        $user->fullname = ucwords(strtolower($request->input('fullname')));
        $user->phone_number = $request->input('phone_number');
        $user->usertype = $request->input('usertype');
        $user->location = ucwords(strtolower($request->input('location')));
        $user->created_by = Auth::user()->getNameOrUsername();
        if ($user->save()) {


            $role = Role::where('name', '=', $assigned_role)->first();
            $user->attachRole($role);

            return redirect()
                ->route('manage-users')
                ->with('success', 'Account has successfully been created!, User can now sign in after approval');
        } else {
            return redirect()
                ->route('manage-users')
                ->with('error', 'Account failed to create');
        }
    
    }



    public function getSignin()
    {
        $company = Company::get()->first();
        return view('auth.signin', compact('company'));
    }

    public function getSigninMobile()
    {
        $company = Company::get()->first();
        return view('auth.mobile', compact('company'));
    }

    public function username()
    {
        return 'username';
    }

    public function postSignin(Request $request)
    {

        $company = Company::get()->first();

        if ($company->security_layer == 'advance') {
            $this->validate($request, [

                'username' => 'required',
                'password' => 'required',
                'g-recaptcha-response' => 'recaptcha',
                //'captcha' => 'required|captcha',

            ]);
        } else if($company->security_layer == 'intermediate'){
            $this->validate($request, [

                'username' => 'required',
                'password' => 'required',
                //'g-recaptcha-response' => 'recaptcha',
                'captcha' => 'required|captcha',

            ]);
        }
        
        else {
            $this->validate($request, [

                'username' => 'required',
                'password' => 'required',
                //  'g-recaptcha-response' => 'recaptcha',
                //'captcha' => 'required|captcha',

            ]);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return redirect()->back()
                ->with('error', 'Your account has been disabled because of too many wrong attempts. Retry in ' . $this->decayMinutes . ' minutes');
        }
        $this->incrementLoginAttempts($request);


        $remember_me = $request->has('remember') ? true : false;

        if (!Auth::attempt($request->only(['username', 'password']), $remember_me)) {
            return redirect()
                ->back()
                ->with('error', 'Invalid Username/Password combination. Please try again');
        }

        if (Auth::user()->status != 'Active') {
            abort(402, 'Your account has been blocked!');
        }

        if (Auth::user()->created_at != Auth::user()->updated_at) {

            if (Auth::user()->usertype == 'Tab') {
                return redirect()
                    ->route('register-quick')
                    ->with('info', 'You are now signed in');
            } else if (Auth::user()->usertype == 'Patient') {
                return redirect()
                    ->route('patient-profile-limited', Auth::user()->username)
                    ->with('info', 'You are now signed in');
            } else {
                if(session()->has('url.intended')){
                    return redirect()->intended();
                }else{
                    return redirect()
                    ->route('home')
                    ->with('info','You are now signed in');
                }
            }
        } else {
            event(new Registered(Auth::user()->username));
            return redirect()
                ->route('reset-password-notice')
                ->with('info', 'First time login, Please reset your passowrd!!!');
        }
    }



    public function resetnotice()
    {
        $company = Company::get()->first();
        return view('auth.notice', compact('company'));
    }



    public function deleteUser(Request $request)
    {

        if ($request->ID) {
            $ID = $request->ID;
            $affectedRows = User::where('id', '=', $ID)->delete();

            if ($affectedRows > 0) {
                $ini   = array('OK' => 'OK');
                return  Response::json($ini);
            } else {
                $ini   = array('No Data' => $ID);
                return  Response::json($ini);
            }
        } else {
            $ini   = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }



    public function searchUser(Request $request)
    {

        $branches = Branch::orderby('branch_name', 'asc')->get();
        $intermediaries = Intermediary::orderby('agentname', 'asc')->get();

        $search = $request->get('search');
        $roles = Role::get();
        $permissions = DB::table("permissions")->get();
        $apiUsers = ApiUser::paginate(30);

        $users = User::where('fullname', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%")
            ->orWhere('usertype', 'like', "%$search%")
            ->orderBy('fullname', 'desc')
            ->paginate(30)
            ->appends(['search' => $search]);

        $userslist = User::get('fullname');

        return view('auth.user', compact('apiUsers', 'userslist', 'users', 'roles', 'permissions', 'branches', 'intermediaries'));
    }




    public function getSignOut()
    {
        Auth::logout();
        Session::flush();
        Redirect::back();
        return redirect(\URL::previous());
    }

    public function getCreateRole()
    {
        $permissions = Permission::get();


        $permissions_collection = collect($permissions)->map(function ($permission) {
            return (object) $permission;
        });
        $permissionsGroup = $permissions_collection->groupBy('description');


        $state = "Create";

        //dd( $permissionsGroup);
        return view('auth.create-role', compact('permissionsGroup', 'permissions', 'state'));
    }






    public function createNewRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('manage-users')
                ->with('error', 'Role failed to create. Kindly ensure role name and permissions are not blank');
        }


        //dd($request->input('permissions'));

        $role = Role::create(['name' => $request->input('role_name')]);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('manage-users')
            ->with('success', 'Role created successfully');
    }


    public function getEditRole($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("permission_role")->where("role_id", $id)
            ->pluck('permission_id', 'permission_id')
            ->all();

        //dd($rolePermissions);

        $permissions_collection = collect($permissions)->map(function ($permission) {
            return (object) $permission;
        });
        $permissionsGroup = $permissions_collection->groupBy('description');
        $state = "Edit";

        return view('auth.create-role', compact('role', 'permissions', 'rolePermissions', 'permissionsGroup', 'state'));
    }


    public function updateRole(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('role_name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('manage-users')
            ->with('success', 'Role updated successfully');
    }

    public function destroyRole(Request $request)
    {

        DB::table("roles")->where('id', $request->input('ID'))->delete();
       
        $ini   = array('OK' => 'OK');
        return  Response::json($ini);


    }


    public function addRoleLimits()
    {
        $affectedRows = UnderwriterLimits::where('id', Input::get("limitkey"));
        //->orwhere('product', Input::get("limit_scope"))->delete();


        //dd(Input::get("cession_number"));
        $limit                = new UnderwriterLimits;
        $limit->level         = Input::get("level");
        $limit->product       = Input::get("limit_scope");
        $limit->sum_insured   = Input::get("limit");
        // $limit->created_by      = Auth::user()->getNameOrUsername();
        //$limit->created_on      = Carbon::now();



        if ($limit->save()) {

            $added_response = array('OK' => 'OK');
            return  Response::json($added_response);
        } else {
            $added_response = array('No Data' => 'No Data');
            return  Response::json($added_response);
        }
    }

    public function getRoleLimits()
    {
        try {
            $role = Input::get("role");

            //dd($role);
            $items = UnderwriterLimits::where('level', $role)->get();
            return  Response::json($items);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function deleteLimit()
    {
        if (Input::get("ID")) {
            $ID = Input::get("ID");
            $affectedRows = UnderwriterLimits::where('id', '=', $ID)->delete();

            if ($affectedRows > 0) {
                $ini   = array('OK' => 'OK');
                return  Response::json($ini);
            } else {
                $ini   = array('No Data' => $ID);
                return  Response::json($ini);
            }
        } else {
            $ini   = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }

    public function editLimit()
    {
        $item = Input::get('id');
        $items = UnderwriterLimits::find($item);
        $data = array(

            'limitkey'       => $items->id,
            'scope'          => $items->product,
            'limit'          => $items->sum_insured

        );
        return Response::json($data);
    }
}
