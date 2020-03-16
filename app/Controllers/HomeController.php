<?php

namespace Course\Controllers;

class HomeController extends Controller
{
    public function index($request)
    {
        return $this->view('index', ['title' => 'Home']);
    }
}
