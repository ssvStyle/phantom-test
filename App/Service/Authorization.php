<?php

namespace App\Service;

use Core\Storage\Bases\Mysql as db;

class Authorization
{
    protected $db;
    protected $login;
    protected $pass;
    protected $hash;
    protected $user;

    /**
     * AuthService constructor.
     * @param \App\Models\Db $db
     *
     */
    public function __construct(Db $db)
    {
            $this->db = $db;

    }

    /**
     * @param $hash
     * 
     * @return bool
     */
    public function userVerify()
    {
        $hash = $_SESSION['UserHash'] ?? false;

        if ($hash) {

            $sql = 'SELECT * FROM users WHERE session_token=:hash';

            if ($this->db->query($sql, [':hash' => $hash])) {

                return true;

            }
        }

        return false;
        
    }

    /**
     *
     * @return mixed
     */

    public function getUid()
    {
        if ($this->userVerify()) {

            $hash = $_SESSION['UserHash'];

            $sql = 'SELECT id FROM users WHERE session_token=:hash';

            return $this->db->query($sql, [':hash' => $hash])[0] ?? false;
        }

    }

    /**
     * @param $status
     *
     * @return bool
     */

    public function userStatusVerify($status = '')
    {
        if ($this->userVerify()) {

            $hash = $_SESSION['UserHash'];

            $sql = 'SELECT status FROM users
                    LEFT JOIN usersStatus ON users.status_id=usersStatus.id WHERE sessionHash=:hash AND status=:status';

            $rez = $this->db->query($sql, [':hash' => $hash, ':status' => $status])[0]['status'] ?? false;

            if ($status === $rez) {

                return true;

            }
        }

        return false;

    }

    /**
     * @param $login
     * 
     * @return bool
     */
    public function loginExist($login)
    {

        $sql = 'SELECT * FROM users WHERE login=:login';

        if($this->db->query($sql, [':login' => $login])) {

            return true;

        }
        return false;
        
    }

    /**
     * @param $login
     * @param $pass
     *
     * @return bool
     */

    public function loginAndPassValidation($login, $pass)
    {
        if ($this->loginExist($login)) {

            $sql = 'SELECT users.id, login, psw, session_token FROM users
                    WHERE login=:login';
            $user = $this->db->queryRetObj($sql, [':login' => $login], '\App\Models\User')[0] ?? false;

            if ($user) {
                if ( password_verify($pass, $user->psw) ) {
                    $this->user = $user;
                    return true;
                }
            }

        }

        return false;

    }

    /**
     * @return bool
     */
    public function setAuth($cookie = false)
    {
        $hash = sha1(microtime() . rand(0, 1000000000));

        $sql = 'UPDATE users SET session_token=:hash WHERE id=:id';

        if ($this->db->execute($sql, [':hash'=> $hash, ':id' => $this->user->id])) {

            $_SESSION['UserHash'] = $hash;
            $_SESSION['name'] = $this->user->login;

            if ($cookie === 'on') {

                setcookie("UserHash", $hash, time() + 3600, '/');
            }

            return true;
        }
    }

    /**
     * @return bool
     */
    public function exitAuth()
    {
        $hashSession = $_SESSION['UserHash'] ?? null;

        $sql = 'UPDATE users SET session_token=:hash WHERE session_token=:hashSession';

        if ($this->db->execute($sql, [':hash'=> '', ':hashSession' => $hashSession])) {

            unset($_SESSION['UserHash']);
            unset($_SESSION['name']);
            setcookie("UserHash", "", time() - 3600*60, '/');
            session_regenerate_id(true);
            return true;

        }

        return false;
    }



}