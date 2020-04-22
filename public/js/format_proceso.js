// Get all the "row_data" elements into an array
// let formatearnumeros = Array.prototype.slice.call(document.querySelectorAll(".format_numero"));
// const regex = /(\d{5})(\d{4})(\d{3})(\d{4})(\d{5})(\d{2})/g;
// const subst = `$1-$2-$3-$4-$5-$6`;
// 
// Loop over the array
// formatearnumeros.forEach(function(formateanumero){   
//     texto = formateanumero.textContent; 
//     formateanumero.textContent = texto.replace(regex, subst);
// });

$(document).ready(function(){
    $('#forma_numero_input').mask('00000-0000-000-0000-00000-00');
});