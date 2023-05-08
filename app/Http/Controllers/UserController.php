<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 1/9/2017
 * Time: 03:21 م
 */

namespace App\Http\Controllers;

use App\Actions\ImageActions;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


    public function index(Request $request)
    {
//        SendAdminNotification::dispatch(2,'test',['test'=>'tes'],1);
        $o =User::where('id','>',1)->orderBy('id','DESC');
        if($request->name){
            $o->where('name', 'like' ,'%'.$request->name.'%');
        }
        if($request->rule_id){
            $role=$request->rule_id;
            $o->whereHas('roles', function (Builder $subQuery) use ($role) {
                $subQuery->where(config('permission.table_names.roles').'.id', $role);
            });
        }
        $out=$o->paginate(20)->appends(\request()->all());
        $roles = Role::where('id', '<>', 1)->get();
        return view('system.users.index', compact('out','roles'));
    }

    public function create(Request $request)
    {

        $n= new User();
        $n->name=$request->name;
        $n->email=$request->email;
        $n->mobile=$request->mobile;
        $n->avatar=ImageActions::SaveFile($request->image);
        $n->password=Hash::make($request->password);
        $n->save();

        $n->syncRoles($request->role_id);

        flash('تم اضافة المدير بنجاح');

        return redirect()->route('system.users.index');
    }


    public function showUpdateView($id)
    {
        $out=User::findOrFail($id);
        $roles = Role::where('id', '<>', 1)->get();
        return view('system.users.update',compact('out','roles'));

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'mobile' => ['required','numeric',Rule::unique('users','mobile')->ignore($id)],
            'email' => ['required','max:255',Rule::unique('users','email')->ignore($id)],
            'image' => 'required',

        ]);

        $n= User::findOrFail($id);
        $n->name=$request->name;
        $n->email=$request->email;
        $n->mobile= $request->mobile;
        if($request->image){
            $n->avatar=$request->image;
            ImageActions::deleteUnUsedFiles($request->image);
        }
        $n->save();
        $n->syncRoles($request->role_id);

        flash('تم تعديل المدير بنجاح');

        return redirect()->route('system.users.index');
    }


    public function delete(Request $request)
    {
        $ids=[];
        if(is_array($request->id)){
            $ids=$request->id;
        }else{
            $ids[]=$request->id;
        }

        foreach ($ids as $id){
            User::destroy($id);
        }
        return ['done'=>1];
    }

    public function showProfileView()
    {
        $out=\Auth::user();
        return view('system.users.profile',compact('out',));

    }

    public function showPasswordView($id)
    {
        $out=User::findOrFail($id);
        return view('system.users.password',compact('out'));

    }

    public function password(Request $request,$id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $n= User::findOrFail($id);
        $n->password=Hash::make($request->password);

        $n->save();

        flash('تم تغيير كلمة المرور بنجاح ');

        return redirect()->route('system.users.index');
    }

    public function profile(Request $request)
    {
        $n= \Auth::user();

        $this->validate($request, [
            'name' => 'required|max:255',
            'mobile' => 'required|unique:users,mobile,'.$n->id,
            'image' => 'required',
            'email' => 'required|max:255|unique:users,email,'.$n->id,
        ]);

        $n->name=$request->name;
        $n->email=$request->email;
        $n->mobile= $request->mobile;
        if($request->image){
            $n->avatar=$request->image;
            ImageActions::deleteUnUsedFiles($request->image);
        }
        $n->save();


        flash('تم تعديل بياناتك بنجاح');

        return redirect()->route('system.dashboard');
    }


    public function showProfilePasswordView()
    {
        return view('system.users.profile_password');

    }


    public function profilePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $n= \Auth::user();

        if (Hash::check($request->old_password, $n->password)) {
            $n->password = bcrypt($request->password);
            $n->save();
            flash('تم تغيير كلمة المررو بنجاح ');

            return redirect()->route('system.users.profile');
        }else{
            return redirect()->back()->withErrors(['old_password'=>'كلمة المرور القديمة خاطئة']);
        }


    }



    public function save_token(Request $request)
    {
        $user= \Auth::user();
        $user->fcm_token = $request->token;
        $user->save();

        if($user)
            return response()->json([
                'message' => 'User token updated'
            ]);

        return response()->json([
            'message' => 'Error!'
        ]);
    }

    public function get_notifications(Request $request)
    {
        if($request->only_count == 1){
            return ['done'=>1,'count'=>auth()->user()->new_notifications_count,'items'=>""];
        }else {
            $out = auth()->user()->new_notifications()->orderBy('id', 'desc')->get();

            $items = View::make('admin.notifications', compact('out'))->render();
//            AdminNotification::whereNull('read_at')->update(['read_at' => now()]);
            return ['done' => 1, 'count' => auth()->user()->new_notifications_count, 'items' => $items];
        }
    }



}
