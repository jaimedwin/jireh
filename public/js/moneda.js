// Get all the "row_data" elements into an array
let cells = Array.prototype.slice.call(document.querySelectorAll(".row_data"));

// Loop over the array
cells.forEach(function(cell){
  // Convert cell data to a number, call .toLocaleString()
  // on that number and put result back into the cell
  cell.textContent = (+cell.textContent).toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
});