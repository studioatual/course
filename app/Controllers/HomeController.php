<?php

namespace Course\Controllers;

class HomeController extends Controller
{
    public function index($request)
    {
        return $this->view('home', ['title' => 'Home']);
    }
}
