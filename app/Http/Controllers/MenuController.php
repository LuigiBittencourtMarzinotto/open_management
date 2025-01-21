<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $menus = MenuModel::all();
       return $menus;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(MenuModel::rules(), MenuModel::feedback());
        $menu = MenuModel::create([
            "menu_description" => $request->menu_description,
            "menu_link" => $request->menu_link,
            "menu_permission" => $request->menu_permission,
            "menu_icon" => $request->menu_icon,
            "menu_nivel" => $request->menu_nivel
        ]);
        return response()->json($request, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(String $menuCodigo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $menuCodigo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $menuCodigo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $menu)
    {
        //
    }
}
