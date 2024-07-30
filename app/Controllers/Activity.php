<?php

namespace App\Controllers;

use App\Models\ActivityModel;

class Activity extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Carrega a sessão
        $this->session = \Config\Services::session();
    }
    public function create()
    {
        return view('create_activity');
    }

    public function store()
{
    // Verifique se o usuário está autenticado
    if (!$this->session->get('isLoggedIn')) {
        return redirect()->to('/auth/login');
    }

    $activityModel = new ActivityModel();

    // Obtém o ID do usuário da sessão
    $userId = $this->session->get('userData')['id'];

    // Salva a atividade
    $activityModel->save([
        'user_id' => $userId,
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'start_datetime' => $this->request->getPost('start_datetime'),
        'end_datetime' => $this->request->getPost('end_datetime'),
        'status' => 'pending'
    ]);

    return redirect()->to('/dashboard');
}

    public function edit($id)
    {
        $activityModel = new ActivityModel();
        $data['activity'] = $activityModel->find($id);

        return view('edit_activity', $data);
    }

    public function getUserActivities()
{
    $activityModel = new ActivityModel();
    $activities = $activityModel->where('user_id', session()->get('userData')['id'])->findAll();

    $events = [];
    foreach ($activities as $activity) {
        $events[] = [
            'id' => $activity['id'],
            'title' => $activity['name'],
            'start' => $activity['start_datetime'],
            'end' => $activity['end_datetime'],
            'description' => $activity['description'],
            'status' => $activity['status']
        ];
    }

    return $this->response->setJSON($events);
}


    public function update($id)
    {
        $activityModel = new ActivityModel();
        $activityModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'start_datetime' => $this->request->getPost('start_datetime'),
            'end_datetime' => $this->request->getPost('end_datetime'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/dashboard');
    }

        public function delete($id)
    {
        $activityModel = new ActivityModel();

        // Verifica se a atividade pertence ao usuário atual
        $activity = $activityModel->find($id);

        if (!$activity || $activity['user_id'] != $this->session->get('userData')['id']) {
            return redirect()->to('/dashboard')->with('error', 'Atividade não encontrada ou não autorizada.');
        }

        $activityModel->delete($id);

        return redirect()->to('/dashboard')->with('message', 'Atividade deletada com sucesso.');
    }

    
}
