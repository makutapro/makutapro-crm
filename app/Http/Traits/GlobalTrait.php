<?php
     
namespace App\Http\Traits;
 
use App\Models\Pt;
use Illuminate\Support\Facades\Auth;
 
trait GlobalTrait {
 
    public function pt() 
    {
        $pt = Pt::with('user')->get();
        return $pt;
    }
}