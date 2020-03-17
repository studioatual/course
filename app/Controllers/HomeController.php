<?php

namespace Course\Controllers;

use Course\Core\Contracts\RequestInterface;

class HomeController extends Controller
{
    public function index(RequestInterface $request)
    {
        return $this->view('home', ['title' => 'Home']);
    }
}
