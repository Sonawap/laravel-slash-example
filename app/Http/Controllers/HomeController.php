<?php

namespace App\Http\Controllers;
use Sonawap\Slash\SlashCoupon;
use Sonawap\Slash\SlashDiscount;

class HomeController extends Controller
{

    public function test(){
        return SlashCoupon::useCoupon("user", "6c25c6e-1fe9-43ce-8bd6-9bc4e22627e4", "tobi", 4000);
    }
}
