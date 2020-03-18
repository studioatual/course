<?php

namespace Course\Controllers;

use Course\Core\Contracts\ContainerInterface;
use Course\Core\Contracts\RequestInterface;
use Course\Models\Customer;

class CustomerController extends Controller
{
    protected $model;
    protected $errors;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new Customer();
        $this->errors = [];
    }

    public function index(RequestInterface $request)
    {
        $customers = $this->model->all();
        return $this->view('customers.index', [
            'title' => 'Customers',
            'customers' => $customers
        ]);
    }

    public function create(RequestInterface $request)
    {
        return $this->view('customers.form', [
            'title' => 'New Customer'
        ]);
    }

    public function store(RequestInterface $request)
    {
        $params = $this->filterParams($request->getParams());

        if (!$this->validateParams($params)) {
            return $this->view('customers.form', [
                'title' => 'Customers',
                'customer' => $params,
                'errors' => $this->errors
            ]);
        }

        $this->model->create($params);
        return $this->withRedirect('/customers');
    }

    public function show(RequestInterface $request)
    {
        $params = $request->getParams();
        $customer = $this->model->first($params['id']);
        return $this->view('customers.form', [
            'title' => 'New Customer',
            'customer' => $customer
        ]);
    }

    private function validateParams($params)
    {
        $validate = true;
        if (!isset($params['name']) || $params['name'] == '') {
            $this->errors['name'] = ['This field is required!'];
            $validate = false;
        }
        if (!isset($params['cpf_cnpj']) || $params['cpf_cnpj'] == '') {
            $this->errors['cpf_cnpj'] = ['This field is required!'];
            $validate = false;
        }
        if (!isset($params['email']) || $params['email'] == '') {
            $this->errors['email'] = ['This field is required!'];
            $validate = false;
        }
        if (!isset($params['id']) && (!isset($params['password']) || $params['password'] == '')) {
            $this->errors['password'] = ['This field is required!'];
            $validate = false;
        }
        if (!isset($params['id']) && (!isset($params['password_confirm']) || $params['password_confirm'] == '')) {
            $this->errors['password_confirm'] = ['This field is required!'];
            $validate = false;
        }
        if (isset($params['password']) && isset($params['password_confirm']) && $params['password'] != $params['password_confirm']) {
            $this->errors['password_confirm'] = ['Password not match!'];
            $validate = false;
        }
        return $validate;
    }

    private function filterParams($params)
    {
        if (isset($params['cpf_cnpj'])) {
            $params['cpf_cnpj'] = preg_replace('/\D/', '', $params['cpf_cnpj']);
        }
        if (isset($params['rg_ie'])) {
            $params['rg_ie'] = preg_replace('/\D/', '', $params['rg_ie']);
        }
        if (isset($params['password']) && isset($params['password']) == '') {
            unset($params['password']);
        }
        if (isset($params['password_confirm']) && isset($params['password_confirm']) == '') {
            unset($params['password_confirm']);
        }
        return $params;
    }
}
