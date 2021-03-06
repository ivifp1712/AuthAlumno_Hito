<style>
  section{
    margin-top: 0px;
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.0.js""></script>
<script>
  function comprobar(valor, tipo) {
    var tipo = tipo;
    function responseD(data) {
        if (data != 0) {
                document.getElementById(tipo).style.borderColor = "#dc3545";
                document.getElementById(tipo).style.backgroundImage = "url(../imgs/descarga1.svg)";
                document.getElementById(tipo).style.paddingRight = "calc(1.5em + .75rem)";
                document.getElementById(tipo).style.backgroundRepeat = "no-repeat";
                document.getElementById(tipo).style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
                document.getElementById(tipo).style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
                document.getElementById("valid-"+tipo).style.display = "none";
                document.getElementById("invalid-"+tipo).style.display = "block";
            }else{
                document.getElementById(tipo).style.borderColor = "#198754";
                document.getElementById(tipo).style.backgroundImage = "url(../imgs/descarga.svg)";
                document.getElementById(tipo).style.paddingRight = "calc(1.5em + .75rem)";
                document.getElementById(tipo).style.backgroundRepeat = "no-repeat";
                document.getElementById(tipo).style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
                document.getElementById(tipo).style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
                document.getElementById("valid-"+tipo).style.display = "block";
                document.getElementById("invalid-"+tipo).style.display = "none";
              
      }}
    if (tipo == "usuario") {
      //var pasar = {"us": valor}
      axios({
      method: 'post',
      url: 'more/existe.php',
      data: {
        us: valor,
      }
      }).then(function (response) {
        console.log(response.data);
        responseD(response.data);
      });
      
    } else {
      //var pasar = {"ma": valor}
      axios({
      method: 'post',
      url: 'more/existe.php',
      data: {
        ma: valor,
      }
      }).then(function (response) {
        responseD(response.data);
      });
    }
    //var contra = valor;
    //console.log(valor)
      
  }
            
function checkpass(v){
    let contra = document.getElementById("pass").value;
    // console.log(v);
    // console.log(contra);
    if (contra == v && contra != " " && v != "") {
              document.getElementById("pass2").style.borderColor = "#198754";
              document.getElementById("pass2").style.backgroundImage = "url(imgs/descarga.svg)";
              document.getElementById("pass2").style.paddingRight = "calc(1.5em + .75rem)";
              document.getElementById("pass2").style.backgroundRepeat = "no-repeat";
              document.getElementById("pass2").style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
              document.getElementById("pass2").style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
              document.getElementById("valid-pass").style.display = "block";
              document.getElementById("invalid-pass").style.display = "none";
    }else{
              document.getElementById("pass2").style.borderColor = "#dc3545";
              document.getElementById("pass2").style.backgroundImage = "url(imgs/descarga1.svg)";
              document.getElementById("pass2").style.paddingRight = "calc(1.5em + .75rem)";
              document.getElementById("pass2").style.backgroundRepeat = "no-repeat";
              document.getElementById("pass2").style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
              document.getElementById("pass2").style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
              document.getElementById("valid-pass").style.display = "none";
              document.getElementById("invalid-pass").style.display = "block";
    }
}
</script>
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" style=" margin-left: 4px !important ;width: 100% !important;margin-right: 0px !important ;margin-top: -5% !important">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Crear usuario!</p>

                <form class="mx-1 mx-md-4" method="post" action="?controller=alumno&&action=save">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Nombre de Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" onkeyup="comprobar(this.value, 'usuario');"required>
                        <div class="valid-feedback" id="valid-usuario">
                          Nombre de usuario v??lido!
                        </div>
                        <div class="invalid-feedback" id="invalid-usuario">
                          Nombre de usuario registrado!
                        </div>
                        <label class="form-label" for="form3Example1c" style="margin-top:5px;">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" onkeyup="comprobar(this.value, 'email');"required>
                        <div class="valid-feedback" id="valid-email">
                          Este email es v??lido!
                        </div>
                        <div class="invalid-feedback" id="invalid-email">
                          Este email no es v??lido!
                        </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Contrase??a</label>
                      <input type="password" id="pass" class="form-control" name="pass" required/>
                      <label class="form-label" >Repetir Contrase??a</label>
                      <input type="password" id="pass2" class="form-control" name="pass2" onkeyup="checkpass(this.value)" required/>
                      <div class="valid-feedback" id="valid-pass">
                          Contrase??a correcta!
                        </div>
                        <div class="invalid-feedback" id="invalid-pass">
                          No se repite la contrase??a!
                        </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="registrar" value="1">Registrarse</button>
                  </div>

                </form>
                <div id="invisible">

                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>