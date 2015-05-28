 <div class="modal fade" id="bloquearanuncio" tabindex="-1" role="dialog" aria-labelledby="bloquearanuncio" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Borrar anuncio</h4>
      </div>
          <div class="modal-body alert alert-danger">
       
       <div><span class="glyphicon glyphicon-warning-sign"></span> ¿Realmente deseas bloquear este anuncio? </div>
       
      </div>
        <div class="modal-footer ">
        <a href="{{ route('admin.bloquearanuncio', [$anuncio->id])  }}" type="button" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
  </div>