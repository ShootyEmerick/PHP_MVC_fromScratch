<?php

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Call the view : (routes = "/user/")
     */
    public function indexAction()
    {
        var_dump("TEST2", isset($_SESSION['id']));

        if (isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/show/');
            exit();
        } else {
            $this->render('index');
        }
    }

    /**
     * Call the view : (routes = "/user/add/")
     */
    public function addAction()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/login/');
            exit();
        } else {
            $this->render('add');
        }
    }

    /**
     * Call the view : (routes = "/user/show/")
     */
    public function showAction()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/login/');
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $params = $this->request->getQueryParams();
                $user = new UserModel($params);
                $dataRender = $user->read($_SESSION['id']);
            } else {
                $this->render('show');
            }
        }
    }

    /**
     * Call the view : (routes = "/user/profile/")
     */
    public function profileAction()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/login/');
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $params = $this->request->getQueryParams();
                $user = new UserModel($params);
                $dataRender = $user->read($_SESSION['id']);
            } else {
                $this->render('profile');
            }
        }
    }


    /**
     * Call the view : (routes = "/user/delete/")
     */
    public function deleteAction()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/login/');
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $params = $this->request->getQueryParams();
                $user = new UserModel($params);
                $dataRender = $user->read($_SESSION['id']);
            } else {
                $this->render('delete');
            }
        }
    }


    /**
     * Call the view : (routes = "/user/register/")
     */
    public function registerAction()
    {
        if (isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/show');
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $this->checkAndHashPassword();
                $params = $this->request->getQueryParams();
                $user = new UserModel($params);
                var_dump("IDIDIDIDID", $user->id, PHP_EOL);
                if (!$user->id) {
                    $user->save();
                    self::$_render = "Votre compte a été créé avec success." . "<br>";
                }
            } else {
                $this->render('register');
            }
        }
    }

    /**
     * Call the view : (routes = "/user/login/")
     */
    public function loginAction()
    {
        if (isset($_SESSION['id'])) {
            header('Location: ' . BASE_URI . '/user/show');
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $this->checkAndHashPassword();
                $params = array(
                    "WHERE" => "",
                    "email =" => "'" . $_POST['email'] . "'",
                    "AND" => "",
                    "password =" => "'" . $_POST['password'] . "'"
                );
                $user = new ORM();
                $found = $user->find("users", $params);
                if (!empty($found)) {
                    $_SESSION['id'] = $found ;
                }
            } else {
                $this->render('login');
            }
        }
    }

    /**
     * Main method for :
     * Check if the password is protected
     * Hash password for insert secured data
     */
    public function checkAndHashPassword()
    {
        if (isset($_POST['password']) && isset($_POST['email'])) {
            if ($this->isPassword($_POST['password'])) {
                $_POST['password'] = $this->hashPassword($_POST['password'], $_POST['email']);
                if (isset($_POST['password_check'])) {
                    $_POST['password_check'] = $this->hashPassword($_POST['password_check'], $_POST['email']);
                }
            }
        }
    }

    /**
     * @param $email
     * @return mixed
     */
    public function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $password
     * @param $email
     * @return string $password hash by hash(sha256)
     */
    public function hashPassword($password, $email)
    {
        $keyPass = substr($email, 0, 4);
        $password = $keyPass . $password;
        $keyPass = substr($email, 0, 2);
        $password .= $keyPass;
        $password = hash("sha256", $password);
        return $password;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function isPassword($password)
    {
        $strength = ['Protection excellente', 'Forte protection', 'Moyenne protection', 'Protection basse'];
        if ($this->enoughLength($password, 8) && $this->containMixedCase($password)
            && $this->containDigits($password) && $this->containSpecialChars($password)) {
            return $strength[0];
        } elseif ($this->enoughLength($password, 6) && $this->containMixedCase($password)
            && $this->containDigits($password)) {
            return $strength[1];
        } elseif ($this->enoughLength($password, 6) && $this->containSpecialChars($password)) {
            return $strength[1];
        } elseif ($this->enoughLength($password, 6) && $this->containMixedCase($password)) {
            return $strength[2];
        } elseif ($this->enoughLength($password, 6) && $this->containDigits($password)) {
            return $strength[2];
        } else {
            return $strength[3];
        }
    }

    /**
     * @param $password
     * @param $length
     * @return bool
     */
    private function enoughLength($password, $length)
    {
        if (empty($password)) {
            return false;
        } elseif (strlen($password) < $length) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $password
     * @return bool
     */
    private function containMixedCase($password)
    {
        if (preg_match("/[a-z]+/", $password) && preg_match("/[A-Z]+/", $password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $password
     * @return bool
     */
    private function containDigits($password)
    {
        if (preg_match("/\d/", $password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $password
     * @return bool
     */
    private function containSpecialChars($password)
    {
        if (preg_match("/[^\da-zPDO::PARAM_STR]/", $password)) {
            return true;
        } else {
            return false;
        }
    }
}
