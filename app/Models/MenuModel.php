<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = 'sys_menu';
    protected $primaryKey = 'menu_codigo'; 
    protected $fillable = [
        'menu_description',
        'menu_link',
        'menu_codigo',
        'menu_icon',
        'menu_nivel',
        'menu_permission'
    ];

    public static function rules(){
        return [
            'menu_description' => 'required|string|max:255',
            'menu_link' => 'required',
            'menu_icon' => 'required',
            'menu_nivel' => 'required',
            'menu_permission' => 'required',
        ];
    } 
    
    public static function feedback(){
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
        ];
    }
}
