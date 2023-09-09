<?php

namespace App\ContohBootcamp\Services;

use App\ContohBootcamp\Repositories\TaskRepository;
use Illuminate\Support\Arr;

class TaskService {
	private TaskRepository $taskRepository;

	public function __construct() {
		$this->taskRepository = new TaskRepository();
	}

	/**
	 * NOTE: untuk mengambil semua tasks di collection task
	 */
	public function getTasks()
	{
		$tasks = $this->taskRepository->getAll();
		return $tasks;
	}

	/**
	 * NOTE: menambahkan task
	 */
	public function addTask(array $data)
	{
		$taskId = $this->taskRepository->create($data);
		return $taskId;
	}

	/**
	 * NOTE: UNTUK mengambil data task
	 */
	public function getById(string $taskId)
	{
		$task = $this->taskRepository->getById($taskId);
		return $task;
	}

	/**
	 * NOTE: untuk update task
	 */
	public function updateTask(array $editTask, array $formData)
	{
		if(isset($formData['title']))
		{
			$editTask['title'] = $formData['title'];
		}

		if(isset($formData['description']))
		{
			$editTask['description'] = $formData['description'];
		}

		$id = $this->taskRepository->save( $editTask);
		return $id;
	}

	/**
	 * NOTE: untuk delete task
	 */
	public function deleteTask(string $id)
	{
		$task = $this->taskRepository->deleteById($id);
	}

	/**
	 * NOTE: untuk create assign task
	 */
	public function addAssign(array $addAssigned, array $formData)
	{
		if(isset($formData['assigned']))
		{
			$addAssigned['assigned'] = $formData['assigned'];
		}

		$id = $this->taskRepository->save($addAssigned);
		return $id;
	}
	
	/**
	 * NOTE: untuk delete assign task
	 */
	public function unAssign(array $unAssigned)
	{
		$unAssigned['assigned'] = null;

		$id = $this->taskRepository->save($unAssigned);
		return $id;
	}

	/**
	 * NOTE: untuk create subtask
	 */
	public function addSubTask($taskId, $title, $description)
	{
		$subtasks = isset($taskId['subtasks']) ? $taskId['subtasks'] : [];

		$subtasks[] = [
			'_id'=> (string) new \MongoDB\BSON\ObjectId(),
			'title'=>$title,
			'description'=>$description
		];

		$taskId['subtasks'] = $subtasks;

		$id = $this->taskRepository->save($taskId);
		return $id;
	}

	/**
	 * NOTE: untuk delete subtask
	 */
	public function deleteSubTask($taskId, $subtaskId)
	{
		$subtasks = isset($taskId['subtasks']) ? $taskId['subtasks'] : [];

		// Pencarian dan penghapusan subtask
		$subtasks = array_filter($subtasks, function($subtask) use($subtaskId) {
			if($subtask['_id'] == $subtaskId)
			{
				return false;
			} else {
				return true;
			}
		});
		
		$subtasks = array_values($subtasks);
		$taskId['subtasks'] = $subtasks;

		$id = $this->taskRepository->save($taskId);
		return $id;
	}
}