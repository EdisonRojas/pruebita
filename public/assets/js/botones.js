$(document).ready(function(){
	 $("#boton-registro").click(function() {
            var $btn = $(this);
            $btn.button('loading');
            // simulating a timeout
            setTimeout(function(){
                $btn.button('reset');
            }, 20000);
        });

                $("#conexion-facebook").click(function() {
                    var $btn = $(this);
                    $btn.button('loading');
                    // simulating a timeout
                    setTimeout(function () {
                        $btn.button('reset');
                    }, 30000);
                });
                $("#conexion-twitter").click(function() {
                    var $btn = $(this);
                    $btn.button('loading');
                    // simulating a timeout
                    setTimeout(function () {
                        $btn.button('reset');
                    }, 30000);
                });
                $("#conexion-google").click(function() {
                    var $btn = $(this);
                    $btn.button('loading');
                    // simulating a timeout
                    setTimeout(function () {
                        $btn.button('reset');
                    }, 30000);
                });
                $("#boton-recuperar").click(function() {
                    var $btn = $(this);
                    $btn.button('loading');
                    // simulating a timeout
                    setTimeout(function () {
                        $btn.button('reset');
                    }, 30000);
                });








});