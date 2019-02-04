//This is the js from the ajax and the options seen from documentation.

var TableDatatables = function(){
   var handleProductTable = function(){
      var productTable = $("#product_list");
      
      var oTable = productTable.dataTable({
         "processing":true,  // Compulsory lines to define the type of code and where is the                         //  code working
         "serverSide":true,  //
         "ajax":{
            url:"http://localhost/erp/pages/scripts/product/manage.php",
            type:"POST", // type of request used.
         },
         "lengthMenu":[
            [5,15,20,-1],
            [5,15,20,"All"]
         ],
         "pageLength":15,//Set the default length
         "order":[
            [1,"desc"]   //Defaults that are set by javascript
         ],
         "columnDefs":[{
            'orderable':false,  
            'targets':[0,-1,-2]
         },
        {
            'orderable': false,
            'targets': [0],
            'data': "img",
            'render': function(data, type, row) {
            var image_name = row[0];
            var result = image_name.split(".");
            if(result[1]!=""){
                return '<img class="img-responsive" height="75px" src="http://localhost/erp/assets/products/images/' + row[0] + '"/>';
            }else{
                return '<img class="img-responsive" src="http://www.placehold.it/75x75/EFEFEF/AAAAAA&amp;text=no+image" alt="" />';
            }
            }
        }],
      });
      productTable.on('click','.edit',function(e){
         $id = $(this).attr('id');
         $("#edit_product_id").val($id);
         $.ajax({
            url:"http://localhost/erp/pages/scripts/product/fetch.php",
            method:"POST",
            data:{product_id:$id},
            dataType:"json",
            success:function(data){
                $("#product_name").val(data.product_name);
                $("#eoq").val(data.eoq);
                $("#additional_specification").val(data.additional_specification);
                $("#rate_of_sale").val(data.rate_of_sale);
                $("#category_name").val(data.category_name);
                $("#supplier_name").val(data.supplier_name);
                $("#editModal").modal('show');
            },
         });
      });
      productTable.on('click','.delete',function(e){
         $id = $(this).attr('id');
         $("#recordID").val($id);
      });
   }
   return{
      //Main function in javascript to handle all the initialisation part 
      init: function(){
         handleProductTable();
      }
   };
}();
jQuery(document).ready(function(){
   TableDatatables.init();
});