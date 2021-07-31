<?php
namespace App\Http\Controllers;

ob_start();

use App\Models\todoModel;

class todoController extends Controller
{
    public function index()
    {
        $todoModel = new todoModel();
        $data["todo_list"] = $todoModel->getTodoList();
        return view("home", $data);
    }

    public function addTodo()
    {
        $todoModel = new todoModel();
        $todo_title = @$_POST["todo_title"];
        print_r(isset($_POST["todo_title"]));
        if ($_POST["todo_title"] != "" || $_POST["todo_title"] != null) {
            $todoModel->saveTodo($todo_title);
            return redirect()->to('/')->send();
        } else {
            return redirect()->to('/?qo=error')->send();
        }

    }

    public function deleteTodo($id)
    {
        $todoModel = new todoModel();
        $todoModel->todoRemove($id);
        return redirect()->to('/')->send();
    }

    public function changeStatusTodo($id)
    {
        $todoModel = new todoModel();
        $todoModel->changeStatus($id);
    }
}
