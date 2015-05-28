 <div class="modal fade" id="denuncia" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> Denuncia si incumple alguna norma</h4>
            </div>
            <form action="{{route('denunciaranuncio')}}" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                   
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <label>Motivo de denuncia</label>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <textarea style="resize:vertical;" class="form-control" placeholder="Detalla el motivo de la denuncia" rows="6" name="motivo" required></textarea>
                        </div>
                    </div>
                </div>  
                <input id="oculto" type="hidden" name="denunciado_id" value={{ $anuncio->usuario_id }}/>
                <input id="oculto" type="hidden" name="identificativo" value={{ $anuncio->id }}/>

                
                <div class="panel-footer">
                    <input type="submit" class="btn btn-danger" value="Denunciar"/>
                       
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                        <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
