<?php




class Alumno{
//atributos de clase
    private $id;
    private $username;
    private $nombre;
    private $email;
    private $avatar;
    private $password;
    private $fecha;
    private $admin;
//constructor
    function __construct($id, $username, $nombre, $email, $avatar, $password, $admin) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setNombre($nombre);
        $this->setEmail($email);
        $this->setAvatar($avatar);
        $this->setPassword($password);
        $this->setAdmin($admin);
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

   
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    public function getFecha()
    {
        require_once("connection.php");
        $mysqli = Db::getConnect();
        $stmt = $mysqli->prepare("SELECT fechainicio from usuarios where id = :id");
        $stmt->bindValue('id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row[0];
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
    public static function save($alumno)
    {
        // cambiar parame
        require_once("connection.php");
        $mysqli = Db::getConnect();
        $hashPassword = password_hash($alumno->getPassword(),PASSWORD_DEFAULT,['cost' => 5]); 
            $stmt = $mysqli->prepare("INSERT INTO usuarios(username, password, email, rol, nombre) VALUES (:username, :password, :email, :rol, :nombre)");
            //$stmt->bindValue("sssss", $usuario, $hashPassword, $email, $admin, $nombre);
            $stmt->bindValue("username", $alumno->getUsername());
            $stmt->bindValue("password", $hashPassword);
            $stmt->bindValue("nombre", $alumno->getNombre());
            $stmt->bindValue("email", $alumno->getEmail());
            $stmt->bindValue("rol", 0);
            $stmt->execute();

            $stmt = $mysqli->prepare("call fechaHoyLogin(:usuario)");
            $stmt->bindValue("usuario", $alumno->getUsername());
            $stmt->execute();
    }

    public static function show(){
        $conexion = Db::getConnect();
        $select = $conexion->query('SELECT * FROM usuarios');
        $row = $select->fetchAll();
        foreach($row as $alumno){
            //$id, $username, $nombre, $email, $avatar, $password
			$listaAlumnos[]=new Alumno($alumno["id"],$alumno["username"], $alumno["nombre"],$alumno["email"], $alumno["avatar"], $alumno["password"], $alumno["rol"]);
		}
        //var_dump($row[0]);
		require_once('Views/Alumno/show.php');
    }

    public static function register()
    {
        require_once("Views/Alumno/register.php");
    }

    public static function existe($valor){
        $conexion = Db::getConnect();
        $select = $conexion->prepare("SELECT * FROM usuarios WHERE username = :username");
        $select->bindValue(':username',$valor[0]);
        $select->execute();
        $row = $select->fetch();
        if (password_verify($valor[1], $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['rol'] = $row['rol'];
            //echo '<p style="color: green;"> Sesión iniciada correctamente! </p>';
            echo '<script>window.location.reload();</script>';
        }else{
            echo '<script>document.getElementById("invisible").innerHTML = "<p>Contraseña incorrecta!</p>" </script>';
        }
    }
    public static function update($up){
        $conexion = Db::getConnect();
        if ($up['id'] == 0) {
            //var_dump ($up);
            $hashPassword = password_hash($up['pass'],PASSWORD_DEFAULT,['cost' => 5]);
            $select = $conexion->prepare("INSERT INTO usuarios (username, nombre, password, email, avatar) values ( :username , :nombre , :password , :email,  :foto)");
            $select->bindValue('username',$up['username']);
            $select->bindValue('password',$hashPassword);
            $select->bindValue('nombre',$up['name']);
            $select->bindValue('email',$up['email']);
            $select->bindValue('foto',"");
            $select->execute();
        }else{
            if (isset($up['username']) && $up['username'] != "") {
                $select = $conexion->prepare("UPDATE usuarios set username = :username where id = :id");
                $select->bindValue(':username',$up['username']);
                $select->bindValue(':id',$up['id']);
                $select->execute();
            }
            if (isset($up['pass']) && $up['pass'] != "") {
                $hashPassword = password_hash($up['pass'],PASSWORD_DEFAULT,['cost' => 5]);
                $select = $conexion->prepare("UPDATE usuarios set password = :pass where id = :id");
                $select->bindValue(':pass',$hashPassword);
                $select->bindValue(':id',$up['id']);
                $select->execute();
            }
            if (isset($up['name']) && $up['name'] != "") {
                
                $select = $conexion->prepare("UPDATE usuarios set nombre = :name where id = :id");
                $select->bindValue(':name',$up['name']);
                $select->bindValue(':id',$up['id']);
                $select->execute();
            }
            if (isset($up['email']) && $up['email'] != "") {
                $select = $conexion->prepare("UPDATE usuarios set email = :email where id = :id");
                $select->bindValue(':email',$up['email']);
                $select->bindValue(':id',$up['id']);
                $select->execute();
            }
            if (isset($up['foto']) && $up['foto'] != "") {
                $select = $conexion->prepare("UPDATE usuarios set url = :foto where id = :id");
                $select->bindValue(':foto',$up['foto']);
                $select->bindValue(':id',$up['id']);
                $select->execute();
            }
        }

    }

    public static function delete($id){
        $conexion = Db::getConnect();
        $select = $conexion->prepare("DELETE from usuarios where id = :id");
        $select->bindValue(':id',$id);
        $select->execute();
        //echo var_dump($select);
    }    
}