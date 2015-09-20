<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SkinsController extends Controller
{
	protected $layout = 'master';
    protected $section = 'skins';
    
    public function index() {
    	return view("skins.index");
    }
}
