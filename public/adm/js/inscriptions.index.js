$(document).ready(function () {
    $('.btnPreview').click(function () {
       var music = $(this).data('music');
       var title = $(this).data('title');
       var type = $(this).data('type');
       var inscription_id = $(this).data('id');

       var html = '';




        if(type == 1) { //se for audio
            html += '<div class="text-center">';
            html += '<audio controls>';
            html += '<source src="' + music + '" type="audio/mpeg">';
            html += 'Your browser does not support the audio element.';
            html += '</audio>';
            html += '</div>';
        } else if(type == 2) { //senão é youtube
            html += '<iframe width="100%" height="385" src="' + music.trim() + '?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        }


        $.alert({
            title: title,
            icon: 'fa fa-music',
            columnClass: 'large',
            type: 'blue',
            content: html,
            buttons : {
                cancel: {
                    text: 'Cancelar', // With spaces and symbol
                    btnClass: 'btn-danger'
                },
                evaluate: {
                    text: '<i class="fa fa-star-half-o"></i> Avaliar',
                    btnClass: 'bg-blue',
                    action: function () {
                        window.location.href = '/admin/inscriptions/' + inscription_id + '/edit'
                    }
                }

            }
        });



    });

    

    $(document).on('click', '.info', function (e) { 
        e.preventDefault();
        
        let id = $(this).data('id');
        let row = $(this).closest('tr');

        $('tr.informations').remove(); //limpa os anteriores
        $('a.infoDel').addClass('info');
        $('a.infoDel').removeClass('infoDel');
        
        $('a.info').children().removeClass('fa-minus-circle');
        $('a.info').children().addClass('fa-plus-circle');


        $(this).removeClass('info');
        $(this).addClass('infoDel');
        $(this).children().removeClass('fa-plus-circle');
        $(this).children().addClass('fa-minus-circle');

        
        
        
        $.ajax({
            type: "get",
            url: "/admin/inscriptions/" + id + '/info',
            dataType: "html",
            success: function (response) {
                console.log(response.id)
                $(row).after(response);
            }
        });

     

        
    });

    $(document).on('click', '.infoDel', function (e) {
        e.preventDefault();
        $(this).removeClass('infoDel');
        $(this).addClass('info');
        $(this).children().removeClass('fa-minus-circle');
        $(this).children().addClass('fa-plus-circle');
        $(this).closest('tr').next().remove();
    })


})