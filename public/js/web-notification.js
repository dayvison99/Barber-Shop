(function () {

    var service_call;
    var service_call_order;
    var WebNotifier = function () {
        this.status = null;
        this.interval = 1000 * 10;

        this.authorize = function (url, type) {
            var notifier = this;
            if (window.Notification && Notification.permission === 'granted') {
                notifier.start(url, type);
            } else if (Notification.permission !== 'denied') {
                window.Notification.requestPermission(function (perm) {
                    notifier.status = perm;
                    notifier.start(url, type);
                });
            }
        };

        this.notify = function (quote, url) {
            var notification = new Notification("Notificação de Pedido", {
                dir: "auto",
                lang: "",
                icon: img_logo,
                Duration: 10,
                body: quote,
                tag: "sometag",
            });

            notification.onclick = function (event) {
                event.preventDefault();
                window.focus();
                window.location.href = url;
            };

            notification.onshow = function () {
                setTimeout(function () {
                    notification.close();
                }, 10000);
            };
        };

        this.addEvents = function () {
            var notifier = this;
            document.querySelector('#auth').addEventListener('click', function () {
                notifier.authorize();
            });
            document.querySelector('#stop').addEventListener('click', function () {
                notifier.stop();
            });
        };

        this.isAuth = function () {
            return this.status === 'granted' ||
                Notification.permission === 'granted';
        };

        this.stop = function () {
            /*var statusElem = document.querySelector('#statusvalue');
            statusElem.setAttribute('class', 'stopped');
            statusElem.innerHTML = 'Stopped';*/
        };

        this.start = function (url, type) {
            var notifier = this;
            var statusElem = document.querySelector('#statusvalue');

            /* Is authorized ? */
            if (this.isAuth()) {
                /* Start */
                var quote = type;
                notifier.notify(quote, url);
                //statusElem.setAttribute('class', 'started');
                //statusElem.innerHTML = 'Started';
            }
        };

        this.init = function (url, type) {
            this.authorize(url, type);
        };
    };

    var tempo_notificacao = 10000;

    var sound = new Audio('public/js/notificacao/notificacao.mp3');

    var webnotifier = new WebNotifier();

    service_call = setInterval(function () {

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: base_url+'/content/class/pedidos_verifica_novo.php',
            async: true,
            success: function(response) {
                try {
                    var x = 0;
                    var pos = 0;
                    var qtd = response.quantidade;

                    if(qtd >= 1){

                    	if(qtd == 1){
                    		var msg = "Você tem 1 novo pedido";
                    	}else{
                    		var msg = "Você tem "+qtd+" novos pedidos";
                    	}

                        webnotifier.init("pedidos", msg);
                        sound.play();
                    }

                } catch(err) {
                    alert('Por favor, recarregue a página.');
                    console.log(err);
                }
            },
            error:function(r){
                console.log(r.responseText);
                console.log(r);
                // alert("Ocorreu algum erro.");
            }
        });

    }, tempo_notificacao);

}());
