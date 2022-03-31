<form action="?controller=alumno&&action=update" method="post">
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="<?php echo sacarDatoss("avatar"); ?>"><span class="font-weight-bold"><?php echo sacarDatoss("nombre"); ?></span><span class="text-black-50">@<?php echo sacarDatoss("username"); ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Perfil:</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre completo</label><input type="text" class="form-control" placeholder="<?php echo sacarDatoss("nombre"); ?>" name="name"></div>
                    <div class="col-md-6"><label class="labels">Username</label><input type="text" class="form-control"  placeholder="<?php echo sacarDatoss("username"); ?>" name="username"></div>
                    <div class="col-md-6"><label class="labels">Correo electronico</label><input type="email" class="form-control" placeholder="<?php echo sacarDatoss("email"); ?>" name="email"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Contraseña</label><input type="text" class="form-control" placeholder="••••••••" name="pass"></div>
                    
                </div>
                <div class="mt-5 text-center"><input type="submit" class="btn btn-primary profile-button" type="button" value="Guardar Cambios"></input><input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" /></form><form action="?controller=alumno&&action=delete" method="post"><button type="submit" class="btn btn-danger" style="margin-left: 1%;" ><i class="fas fa-trash-alt"></i>Eliminar usuario</button></div></form>
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
                
            </div>
        </div>
    </div>
</div>
</div>

</div>

