<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{


    public function index(Request $request)
    {
        $o = Role::where('id','<>',1)->orderBy('id', 'DESC');
        $out = $o->paginate(20);
        return view('system.roles.index', compact('out'));
    }

    public function showCreateView()
    {

        $permission = Permission::get();

        $permissions=[];
        foreach ($permission as $item) {
            $per=explode('.',$item->name);
            $permissions[$per[0]][$per[1]]=$item->id;
        }
        return view('system.roles.create', compact( 'permissions'));
    }


    public function create(Request $request){
      //  return $request;
        $this->validate($request, [
            'name' => 'required|unique:roles,name|min:3',
            'permissions' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name'=>'web'
        ]);

        $role->syncPermissions([$request->input('permissions')]);

        flash('تم  الاضافة بنجاح');
        return redirect(route('system.roles.index'));
    }

    public function showUpdateView($id)
    {
        $out = Role::find($id);

        $permission = Permission::get();
        $permissions=[];
        foreach ($permission as $item) {
            $per=explode('.',$item->name);
            $permissions[$per[0]][$per[1]]=$item->id;
        }
        return view('system.roles.update', compact('out', 'permissions'));
    }


    public function Update(Request $request, $id)
    {
       // return $request;
        $role  = Role::findOrfail($id);
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id,
            'permissions' => 'required',
        ]);

        $role->update([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($request->input('permissions'));

        flash('تم التعديل بنجاح');

        return redirect()->route('system.roles.index');
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
            Role::destroy($id);
        }
        return ['done'=>1];
    }
}
