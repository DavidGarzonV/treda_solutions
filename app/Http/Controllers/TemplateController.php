<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class TemplateController extends BaseController
{

    public function __construct()
    {
    }


    public function getTemplate()
    {
        return view("index");
    }
}
