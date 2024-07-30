<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Carrega a sessão
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        return view('login');
    }

    public function loginCheck()
    {
        // Validação dos dados do login
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('login', ['validation' => $validation]);
        }

        // Verificação dos dados do usuário
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();
        
        // Debug dos dados
        echo '<pre>';
        echo 'Password provided: ' . htmlspecialchars($this->request->getPost('password')) . '<br>';
        echo 'Password type: ' . gettype($this->request->getPost('password')) . '<br>';
        echo 'User data: ' . print_r($user, true) . '<br>';
        echo 'User password: ' . htmlspecialchars($user['password']) . '<br>';
        echo 'Password verify result: ' . ($this->request->getPost('password') === $user['password'] ? 'true' : 'false');
        echo '</pre>';

        if ($user && $this->request->getPost('password') === $user['password']) {
            // Definir dados da sessão
            $this->session->set('isLoggedIn', true);
            $this->session->set('userData', [
                'id' => $user['id'],
                'username' => $user['username'],
                'email'    => $user['email'],
            ]);

            return redirect()->to('/dashboard');
        } else {
            return view('login', ['validation' => $validation, 'error' => 'Invalid login credentials']);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function registerSave()
{
    // Validação dos dados de registro
    $validation = \Config\Services::validation();
    $validation->setRules([
        'username' => 'required|min_length[3]|max_length[20]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'confirm_password' => 'matches[password]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return view('register', ['validation' => $validation]);
    }

    // Armazena os dados do usuário
    $userModel = new UserModel();
    $userModel->save([
        'username' => $this->request->getPost('username'),
        'email'    => $this->request->getPost('email'),
        'password' => $this->request->getPost('password'), // Senha em texto puro
    ]);

    return redirect()->to('/auth/login');
}

    public function dashboard()
{
    if (!$this->session->get('isLoggedIn')) {
        return redirect()->to('/auth/login');
    }

    $userData = $this->session->get('userData');
    $userId = $userData['id']; // Assume that user ID is stored in session

    // Carregar atividades do usuário
    $activityModel = new \App\Models\ActivityModel();
    $activities = $activityModel->where('user_id', $userId)->findAll();

    return view('dashboard', [
        'user' => $userData,
        'activities' => $activities,
    ]);
}

    public function deleteActivity($id)
{
    $activityModel = new \App\Models\ActivityModel();
    $activityModel->delete($id);

    return redirect()->to('/dashboard');
}


}
