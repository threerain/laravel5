<?php

namespace App\Http\Controllers\Rbac;

use App\Http\Controllers\Controller;
use App\models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Input::get('name');
        $pageSize = Input::get('pageSize');
        return $roles =  Role::when($name, function ($query) use ($name) {
            return $query->where('name','like',"$name%");
        })->paginate($pageSize);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->params;
        $role = new Role();
        $role->name = $input['name'];
        $role->description = $input['description'];
        if($role->save()){
            return [
                'msg'=>'保存成功！',
                'code'=>200
            ];
        }
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->params['name'];
        $role->description = $request->params['description'];
        if($role->save()){
            return [
                'msg'=>'保存成功！',
                'code'=>200
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Role::destroy($id);
    }
}
