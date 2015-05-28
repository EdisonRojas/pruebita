<div class="col-xs-12  col-sm-offset-2 col-sm-4 ">
	<a href="{{ route('admin.activaranuncio', [$anuncio->id]) }}" class="btn col-xs-12 btn-success" title="">
		<i class="glyphicon glyphicon-ok">
       	</i>APROBAR ANUNCIO
	</a>
</div>
<div class="col-xs-12  col-sm-offset-1 col-sm-4 ">
	<a href="{{ route('admin.rechazaranuncio', [$anuncio->id])  }}" class="btn btn-danger col-xs-12">
   	<i class="glyphicon glyphicon-remove-circle">
      	</i>
       		RECHAZAR ANUNCIO
   		</a>
</div>