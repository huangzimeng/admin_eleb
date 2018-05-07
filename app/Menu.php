<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected  $guarded=[];
    //拼接菜单

    static public function menus()
    {
        $html = '';
        $first = DB::table('menus')->where('parent_id',0)->get();
        foreach($first as $item){
            $children_html='';
            $second= DB::table('menus')->where('parent_id',$item->id)->get();
            foreach($second as $value){
                if (Auth::user()->can($value->address))
                    $children_html .= '<li><a href="'.route($value->address).'">'.$value->name.'</a></li></li>';
            }
            if ($children_html ==''){
                continue;
            }
            $html .= '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$item->name.'<span class="caret"></span></a><ul class="dropdown-menu">';
            $html .= $children_html;
            $html .= '</ul></li>';
        }
        return $html;
    }
}
