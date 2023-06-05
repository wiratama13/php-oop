<?php

class Auth
{

    /**
     * @var
     * menyimpan koneksi database
     */

    private $db;


    /**
     * @var
     * menyimpan eror message
     */
    private $error;

    public function __construct($db)
    {
        $this->db = $db;

        // mulai session
        session_start();
    }

    /**
     * register
     */

    public function register($name, $email, $password, $level)
    {
        try {
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

            // masukkan user ke database
            $stmt = $this->db->prepare("INSERT INTO users (name,email,password,level) 
                VALUES(:name,:email,:password,:level)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashPasswd);
            $stmt->bindParam(":level", $level);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Jika terjadi error

            if ($e->errorInfo[0] == 2300) {
                //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique

                $this->error = "email sudah digunakan";

                return false;
            } else {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function login($email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email ");

            $stmt->bindParam(":email", $email);

            $stmt->execute();

            $data = $stmt->fetch();

            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $data['password'])) {
                    $_SESSION['user_session'] = $data['id'];
                    $_SESSION['level'] = $data['level'];

                    return true;
                } else {
                    $this->error = "email atau password salah";
                    return false;
                }
            } else {
                $this->error = "email atau password salah";

                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public function isLoggedIn()
    {

        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    /**
     * @return false
     * 
     * fungsi ambil data user yang sudah login
     */

    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return false;
        }

        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindparam(":id", $_SESSION['user_session']);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {

            echo $e->getMessage();
            return false;
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    public function getLastError()
    {
        return $this->error;
    }

    public function get()
    {
        $row = $this->db->prepare("SELECT * FROM category INNER JOIN news on category.id=news.id_category");
        $row->execute();
        $data = $row->fetchAll();
        return $data;
    }

    public function getNews()
    {
        $row = $this->db->prepare("SELECT * FROM news");
        $row->execute();
        $data = $row->fetchAll();
        return $data;
    }

    public function getCategory()
    {
        $row = $this->db->prepare("SELECT * FROM category");
        $row->execute();
        $data = $row->fetchAll();
        return $data;
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id=:id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function createData($title, $description, $id_category)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO news (title,description,id_category) VALUES (:title, :description,:id_category)");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":id_category", $id_category);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function update($id, $title, $description, $id_category)
    {
        try {

            // $query = $this->db->prepare('UPDATE news set title=?,description=? where id=?');

            // $query->bindParam(1, $title);
            // $query->bindParam(2, $description);
            // $query->bindParam(3, $id);

            // $query->execute();
            // return $query->rowCount();

            $sql = 'UPDATE news SET title = :title, description = :description, id_category = :id_category WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'title' => $title,
                'description' => $description,
                'id_category' => $id_category,
                'id' => $id
            ]);
            $data = $stmt->rowCount();
            return $data;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = ?");
// DELETE FROM `news` WHERE `id`= 1
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $delete = $stmt->rowCount();
        return $delete;
    }
}
