<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 13:18
 */

//to send variables to views, you need to fill data assoc array
class PageController extends Controller
{
    /**
     * Handles the Index page
     */
    public function actionIndex() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $tasks = new TaskGroup($page, isset($_COOKIE['sortCookie']) ? $_COOKIE['sortCookie'] : null);

        if(isset($_POST['sort'])) {
            setcookie('sortCookie', $_POST['sort'], time() + 60);
            $tasks->setCriteria($_POST['sort']);
            $tasks->sort();
        }

        $this->data['itemsPerPage'] = $tasks->getItemsPerPage(3);

        $this->data['pagination'] = new Pagination([
            'itemsCount' => $tasks->getCount(),
            'itemsPerPage' => 3,
            'currentPage' => $page,
        ]);
    }

    /**
     * Handles the Add Task page
     */
    public function actionAdd() {

        $addForm = new AddTaskForm();
        $this->data['error'] = '';

        if(isset($_POST['add_submit'])) {

            if($addForm->load($_POST, isset($_FILES['img_path']) ? $_FILES : null)) {

                if(SQLHandler::saveTask(new Task($addForm->username, $addForm->email, $addForm->task_body, $addForm->img_path)))
                    $this->data['error'] = 'Success';
                else
                    $this->data['error'] = 'Failed saving task';
            }
            else {
                $this->data['error'] = $addForm->error;
            }
        }
    }

    /**
     * Handling admin page
     */
    public function actionAdmin() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $taskGroup = new TaskGroup($page, isset($_COOKIE['sortCookie']) ? $_COOKIE['sortCookie'] : null);

        if(isset($_POST['sort'])) {
            setcookie('sortCookie', $_POST['sort'], time() + 60);
            $taskGroup->setCriteria($_POST['sort']);
            $taskGroup->sort();
        }

        $this->data['itemsPerPage'] = $taskGroup->getItemsPerPage(3);

        $this->data['pagination'] = new Pagination([
            'itemsCount' => $taskGroup->getCount(),
            'itemsPerPage' => 3,
            'currentPage' => $page,
        ]);

        $tasks = $taskGroup->getTasks();
        $adminForm = new AdminForm();
        $this->data['error'] = '';
        for($i = 0; $i < count($tasks); $i++) {
            if(isset($_POST[$tasks[$i]->id])) {

                if($adminForm->load($_POST, $_POST[$tasks[$i]->id])) {
                    $adminForm->save();
                    header('Refresh: 0');
                } else
                    $this->data['error'] = $adminForm->error;
            }
        }
    }

    public function actionRegister() {

    }

    public function actionLogin() {
        $loginForm = new LoginForm();
        $this->data['error'] = '';

        if(isset($_POST['login_submit'])) {

            if ($loginForm->load($_POST)) {
                $loginForm->login();
            }
            $this->data['error'] = $loginForm->error;
        }
    }
}