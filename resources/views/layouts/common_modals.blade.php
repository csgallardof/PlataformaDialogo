<!-- #modal-dialog -->
<div class="modal fade" id="login-mipro-dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Ingresar al Sistema</h4>
      </div>

      <div class="modal-body">
        <form action="index.php" method="POST" class="margin-bottom-0">
            <div class="form-group m-b-10">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" class="form-control input-lg" name= "usuario" placeholder="Dirección de email" />
            </div>
            <div class="form-group m-b-10">
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" class="form-control input-lg" name= "clave" placeholder="Contraseña" />
                <br>
            </div>
            <div class="modal-footer">
              <a href="javascript:;" class="btn btn-primary btn-sm m-r-5 pull-right" data-dismiss="modal">Cerrar</a>
              <button type="submit" class="btn btn-primary btn-sm m-r-5">Ingresar</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- #end-modal-dialog -->
