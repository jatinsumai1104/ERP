//This is the js from the ajax and the options seen from documentation.

var TableDatatables = function(){
   var handleSupplierTable = function(){
      var supplierTable = $("#supplier_list");
      
      var oTable = supplierTable.dataTable({
         "processing":true,  // Compulsory lines to define the type of code and where is the                         //  code working
         "serverSide":true,  //
         "ajax":{
            url:"http://".SERVER."/erp/pages/scripts/supplier/manage.php",
            type:"POST", // type of request used.
         },
         "lengthMenu":[
            [5,15,20,-1],
            [5,15,20,"All"]
         ],
         "pageLength":15,//Set the default length
         "order":[
            [0,"desc"]   //Defaults that are set by javascript
         ],
         "columnDefs":[{
            'orderable':false,  
            'targets':[-1,-2]
         }]
      });
      supplierTable.on('click','.edit',function(e){
         $id = $(this).attr('id');
         $("#edit_supplier_id").val($id);
         $.ajax({
            url:"http://localhost/erp/pages/scripts/supplier/fetch.php",
            method:"POST",
            data:{supplier_id:$id},
            dataType:"json",
            success:function(data){
               $("#supplier_name").val(data.supplier_name);
               $("#supplier_address").val(data.supplier_address);
               $("#supplier_contact").val(data.supplier_contact);
               $("#supplier_email").val(data.supplier_email);
               $("#gst_no").val(data.gst_no);
               $("#editModal").modal('show');
            },
         });
      });
      supplierTable.on('click','.delete',function(e){
         $id = $(this).attr('id');
         $("#recordID").val($id);
      });
   }
   return{
      //Main function in javascript to handle all the initialisation part 
      init: function(){
         handleSupplierTable();
      }
   };
}();
jQuery(document).ready(function(){
   TableDatatables.init();
});