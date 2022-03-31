<style>
    img{
        width: 50px;
    }
    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>


<div class="row flex-lg-nowrap" style="width: 90%; margin-left: 5%; margin-top: 2%">

      <div class="col mb-3">
        <div class="e-panel card">
          <div class="card-body">
            <div class="card-title">
              <h2 style="text-align: center; color: black" >Todos los alumnos</h2>
              <h6 class="mr-2" id="title"><span>Usuarios</span><small class="px-1"> - Ordenados por antigüedad</small></h6>
            </div>
            <div class="e-table">
              <div class="table-responsive table-lg mt-3">
                
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      
                      <th>Avatar</th>
                      <th> Username</th>
                      <th class="max-width">Nombre Completo</th>
                      <th>E-mail</th>
                      <th class="sortable">Fecha de inicio</th>
                      <th>Admin</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>
                        <?php foreach ($listaAlumnos as$alumno) {?>
                            
                            <tr>
                                <td><img src=" <?php echo $alumno->getAvatar(); ?> "></td>
                                <td><?php echo $alumno->getUsername(); ?></td>
                                <td><?php echo $alumno->getNombre(); ?></td>
                                <td><?php echo $alumno->getEmail(); ?></td>
                                <td><?php echo $alumno->getFecha(); ?></td>
                                <td><?php 
                                  $id = `'`.$alumno->getId().`'`;
                                  
                                    if ($alumno->getAdmin() == 0) {
                                        echo '<div id="admin-'.$alumno->getId().'">';
                                        echo '<img src="imgs/toggle-off-solid.svg" class="toggle" onclick="cambiar('.$id.')">';
                                        echo '</div>';
                                    } else {
                                      echo '<div id="admin-'.$alumno->getId().'">';
                                      echo '<img src="imgs/toggle-on-solid.svg" class="toggle" onclick="cambiar('.$id.')">';
                                      echo '</div>';
                                    }
                                    
                                
                                
                                 ?></td>
                                <td><form action="?controller=alumno&&action=delete" method="post" width="width:50%"><button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button> <input type="hidden" name="id" value="<?php echo $alumno->getID(); ?>"><button onclick="cDatos('<?php echo $alumno->getID(); ?>')" type="button" class="btn btn-success  " data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></button></td></form>
                                
                            </tr>
                            <?php } ?>    
                </tbody>
        </table>
        <button onclick="cDatos(0)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>Añadir usuario</button>
        </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cambiar los datos</h5>
        <button type="button" class="btn-close close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                              <form  method="post" action="?controller=alumno&&action=update">

                                <div class="d-flex flex-row align-items-center mb-4">
                                  <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                  <div class="form-outline flex-fill mb-0">
                                      <label class="form-label" for="form3Example1c">Nombre de Usuario</label>
                                      <input type="text" id="usuario" name="username" class="form-control" >
                                      <label class="form-label" for="form3Example1c">Nombre Completo</label>
                                      <input type="text" id="name" name="name" class="form-control" >
                                  </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                  <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                  <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example4c">Contraseña</label>
                                    <input type="password" id="pass" class="form-control" name="pass" />
                                  </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                  <i class="fas fa-at fa-lg me-3 fa-fw"></i>
                                  <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example4c">Correo electronico</label>
                                    <input type="email" id="email" class="form-control" name="email" />
                                  </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                  <i class="fas fa-file-image fa-lg me-3 fa-fw"></i>
                                  <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example4c">URL de la foto</label>
                                    <input type="text" id="foto" class="form-control" name="foto" />
                                  </div>
                                </div>
                                <div id="invisible">

                              </div>
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                  <button type="submit" class="btn btn-primary btn-lg" name="update" value="1">Actualizar datos</button>
                                </div>

                              </form>
                              
                            </div>             
            </div>
    </div>
         
  </div>

</div>

<style id="style-modal">

</style>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

var modal2 = document.getElementById("style-modal");
// Get the <span> element that closes the modal
var span = document.getElementById("close");

// When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

function abrir(){
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
            <script>
                function cDatos(v) {
                  modal.style.display = "block";
                  if (v != 0) {
                    axios({
                    method: 'post',
                    url: 'more/cdatos.php',
                    data: {
                      id: v,
                    }
                    }).then(function (response) {
                      //console.log(response);
                      let data = response.data;
                      document.getElementsByName('username')[0].placeholder=data.username;
                      document.getElementsByName('name')[0].placeholder=data.name;
                      document.getElementsByName('email')[0].placeholder=data.email;
                      document.getElementsByName('foto')[0].placeholder=data.foto;
                      document.getElementById('invisible').innerHTML= '<input type="hidden" value="'+data.id+'" name="id" >';
                    });
                  }else{
                    document.getElementById('invisible').innerHTML= '<input type="hidden" value="0" name="id">';
                  }
                    
                  }
                function exito() {
                    window.location.href = "vuelta2.php";
                } 	
                function error() {
                    window.location.href = "../err/vuelta2.php";
                }
              function cambiar(v){
                axios({
                    method: 'post',
                    url: 'more/admin.php',
                    data: {
                      id: v,
                    }
                    }).then(function (response) {
                      let data = response.data;
                      console.log(data);
                      if (data == 1) {
                        console.log(v);
                        clave = 'admin-'+v
                        console.log(clave)
                        document.getElementById('admin-'+v).innerHTML = '<img src="imgs/toggle-on-solid.svg" id="admin-'+v+'" class="toggle" onclick="cambiar('+v+')">';
                      }else if (data == 0){
                        console.log(v);
                        clave = 'admin-'+v
                        console.log(clave)
                        document.getElementById('admin-'+v).innerHTML = '<img src="imgs/toggle-off-solid.svg" id="admin-'+v+'" class="toggle" onclick="cambiar('+v+')">';
                      }
                    });
              }
            </script>

            
    
