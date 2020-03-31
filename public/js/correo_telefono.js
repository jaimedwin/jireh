$(document).ready(function () {
    var counter_tel = 1;
    $('#tableTelefono').on('click', 'a[id ="deleteTel"]', function () {
        $(this).closest('tr').remove();
    })

    $('p a[id="insertTel"]').click(function () {
        counter_tel++;
        var cols = '';
        cols += '<tr>'
        cols += '<th scope="row">' + 
                    '<div class="form-group clearfix">' +
                        '<div class="icheck-primary d-inline">' + 
                            '<input type="radio" name="telefono_principal" id="telefono_radio' + counter_tel + '" value="tr' + counter_tel + '">' +
                            '<label for="telefono_radio' + counter_tel + '"></label>' +
                        '</div>' +
                    '</div>' + 
                '</th>'
        cols += '<td><input type="text" class="form-control" name="telefono_prefijo[]" /></td>'
        cols += '<td><input type="text" class="form-control" name="telefono_numero[]" /></td>'+
                '<input type="hidden" class="form-control" name="telefono_select[]" value="tr' + counter_mail + '"></td>'
        cols += '<td><a id="deleteTel" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>'
        cols += '</tr>'
        $('#tableTelefono').append(cols)  
    }); 

    var counter_mail = 1;
    
    $('#tableCorreo').on('click', 'a[id ="deleteCorreo"]', function () {
        $(this).closest('tr').remove();
    })

    $('p a[id="insertCorreo"]').click(function () {
        counter_mail++;
        var cols = '';
        cols += '<tr>'
        cols += '<th scope="row">' + 
                    '<div class="form-group clearfix">' +
                        '<div class="icheck-primary d-inline">' + 
                            '<input class="form-check-input" type="radio" name="correo_principal" id="correo_radio' + counter_mail + '"value="cr' + counter_mail + '">' +
                            '<label class="form-check-label" for="correo_radio' + counter_mail + '"></label>' + 
                        '</div>' +
                    '</div>' + 
                '</th>'
        cols += '<td><input type="text" class="form-control" name="correo_electronico[]" />'+
                '<input type="hidden" class="form-control" name="correo_select[]" value="cr' + counter_mail + '"></td>'
        cols += '<td><a id="deleteCorreo" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>'
        cols += '</tr>'
        $('#tableCorreo').append(cols)  
    }); 
    
});