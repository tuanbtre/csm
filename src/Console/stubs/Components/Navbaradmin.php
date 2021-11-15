<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Functions;
use Auth;

class Navbaradmin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $listfunc = [];
        if(Auth::guard('admin')->check())
        {
            if(Auth::guard('admin')->user()->isadmin)
            {
                $listfunc   = Functions::where('isshow', 1)->orderBy('parent_id')->orderBy('id')->get();   
            }else{
                $listright = Auth::user()->func()->where('isshow', 1)->pluck('tbl_function.id'); 
                $listfunc = Functions::where([['isshow', 1],['can_grant', 0]])->orWhereIn('id', $listright)->orderBy('parent_id')->orderBy('id')->get();               
            }
            return view('components.navbaradmin', compact('listfunc'));               
        }
    }
}
