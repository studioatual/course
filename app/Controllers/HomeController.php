<?php

namespace Course\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('index', ['title' => 'Home']);
    }
}
