<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Query;

class Main extends Controller{

	// ========================================
	public function index(){

		// Get all jobs from Database
		$data['jobs'] = $this->getAllJobs();

		// Display the home page
		return view('home', $data);
	}

	// ========================================
	public function new_job(){

		return view('new_job');
	}

	// ========================================
	public function newJobSubmition(){

		if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
			return redirect()->to(site_url('main'));
		}

		// Guardar tarefa na base de dados
		$params = [
			'job' => $this->request->getPost('job_name')
		];

		$db = db_connect();
		$db->query('
			INSERT INTO jobs(job, datetime_created)
			VALUES(:job:, NOW())
		',$params);
		$db->close();

		// Redirecionar para a página inicial
		return redirect()->to(site_url('main'));
	}

	// ========================================
	public function jobDone($id_job = -1){

		// Atualizar na Base de dados a tarefa como tendo sido realizada
		$params = [
			'id_job' => $id_job
		];

		$db = db_connect();
		$db->query("
			UPDATE jobs
			SET datetime_finished = NOW(),
			datetime_updated = NOW()
			WHERE id_job = :id_job:",
		$params);
		$db->close();

		// Atualizar a página inicial
		return redirect()->to(site_url('main'));
	}

	// ========================================
	public function editJob($id_job = -1){

		// Carrega os dados da tarefa
		$params = [
			'id_job' => $id_job
		];

		$db = db_connect();
		$dados = $db->query("SELECT * FROM jobs 
							 WHERE id_job = :id_job:",
		$params)->getResultObject();
		$db->close();

		$data['job'] = $dados[0];
		return view('edit_job',$data);
	}

	// ========================================
	public function editJobSubmition(){

		// Atualizar a definição da tarefa na base de dados
		$params = [
			'id_job' => $this->request->getPost('id_job'),
			'job' => $this->request->getPost('job_name')
		];
		$db = db_connect();
		$db->query('UPDATE jobs 
					SET job = :job:,
					datetime_updated = NOW()
					WHERE id_job = :id_job:',
		$params);
		$db->close();

		// Atualizar a pagina inicial
		return redirect()->to(site_url('main'));
	}

	// ========================================
	public function deletejob($id_job = -1){

		// Apresenta a view a questionar a eliminacao da tarefa
		$params = [
			'id_job' => $id_job
		];
		$db = db_connect();
		$data['job'] = $db->query("SELECT * FROM jobs
								   WHERE id_job = :id_job:",
		$params)->getResultObject()[0];
		$db->close();

		// Apresenta a view
		return view('delete_job',$data);
	}

	// ========================================
	public function deleteJobConfirm($id_job = -1){

		// Delete da tarefa na bd
		$params = [
			'id_job' => $id_job
		];
		$db = db_connect();
		$db->query('DELETE FROM jobs WHERE id_job = :id_job:',$params);
		$db->close();

		// Atualização da pagina inicial
		return redirect()->to(site_url('main'));
	}

	// ========================================
	// PRIVATE
	// ========================================
	private function getAllJobs(){

		// Connection Query & Close Database
		$db = db_connect();
		$dados = $db->query('SELECT * FROM jobs')->getResultObject();
		$db->close();

		return $dados;
	}
}