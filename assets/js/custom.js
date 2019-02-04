/*******************************Request Item.js File******************************/
function generateElements(id){
//    window.alert(id);
    var currentId = (parseInt(id)-1);
    $("#request-items").append("<div class='form-group row' id='item"+id+"'><div class='col-md-4'><label>Item Name</label><select name='item_name[]' class='form-control select2' id='item"+id+"_name'><option></option><option value='1'>Computer</option><option value='2'>Projector</option><option value='3'>Printer</option><option value='4'>Breadboard</option><option value='5'>Speakers</option><option value='6'>USB Driver</option><option value='7'>Circuit Kit</option><option value='8'>Chairs</option><option value='9'>Marker/chalk</option><option value='10'>Welding Machine</option></select></div><div class='col-md-4'><label>Item Quantity</label><select name='quantity[]' class='form-control select2' id='item"+id+"_quantity'><option></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='10'>10</option><option value='100'>100</option></select></div><div id='item"+id+"_add_button' class='col-md-2'><label for='' style='display:block'>&nbsp;</label><button type='button'  class='btn btn-primary btn-sm' onclick =\"generateElements('"+(parseInt(id)+1)+"')\"><i class='fa fa-plus'></i></button></div><div  id='item"+id+"_remove_button'='col-md-2'><label for='' style='display:block'>&nbsp;</label><button type='button'  class='btn btn-danger btn-sm' onclick =\"removeElement('"+id+"')\"><i class='fa fa-trash'></i></button></div></div>");
    $("#item"+currentId+"_add_button").remove();
    $("#item"+currentId+"_remove_button").remove();
     $(".select2").select2({
       placeholder: "Select...",
   });
}

function removeElement(id){
    //window.alert(id);
    $("#item"+id).remove();
    var previousId = parseInt(id)-1;
//    window.alert(previousId);
    if(previousId!=1)
        $("#item"+previousId).append("<div id='item"+previousId+"_add_button' class='col-md-2'><label for='' style='display:block'>&nbsp;</label><button type='button'  class='btn btn-primary btn-sm' onclick =\"generateElements('"+id+"')\"><i class='fa fa-plus'></i></button></div><div  id='item"+previousId+"_remove_button'='col-md-2'><label for='' style='display:block'>&nbsp;</label><button type='button'  class='btn btn-danger btn-sm' onclick =\"removeElement('"+previousId+"')\"><i class='fa fa-trash'></i></button></div>");
    else
        $("#item"+previousId).append("<div id='item"+previousId+"_add_button' class='col-md-2'><label for='' style='display:block'>&nbsp;</label><button type='button'  class='btn btn-primary btn-sm' onclick =\"generateElements('"+id+"')\"><i class='fa fa-plus'></i></button></div>");
}
$(document).ready(function(){
    
    
   $(".select2").select2({
       placeholder: "Select...",
   });
    
    $.ajax({
       url:'../../',
        method:"post",
        data:{},
        dataType:"json",
        success:function(data){
            $("#item_name").empty();
            $.each(data,function(i,d){
               $("#item_name").append("<option value='"+d.item_id+"'>"+d.item_name+"</option>");
            });
        }
    });
});

/**********************************File UPload Js ****************************/
$("#dropzone_id").dropzone({});


