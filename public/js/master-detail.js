$(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#atestado' + row_number).html($('#atestado' + new_row_number).html()).find('td:first-child');
      $('#products_table').append('<tr id="atestado' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#atestado" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });