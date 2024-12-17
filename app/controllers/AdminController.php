<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function index()
    {
        $admins = $this->adminModel->all();
        $this->view('admins/index', compact('admins'));
    }

    public function edit($id)
    {
        $admin = $this->adminModel->find($id);
        $this->view('admins/edit', compact('admin'));
    }

    public function update($id)
    {
        $this->adminModel->update($id, $_POST);
        header('Location: /admins');
    }

    public function delete($id)
    {
        $this->adminModel->delete($id);
        header('Location: /admins');
    }
}