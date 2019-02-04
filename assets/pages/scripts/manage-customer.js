//This is the js from the ajax and the options seen from documentation.

var TableDatatables = function(){
   var handleCustomerTable = function(){
      var customerTable = $("#customer_list");
      
      var oTable = customerTable.dataTable({
         "processing":true,  // Compulsory lines to define the type of code and where is the                         //  code working
         "serverSide":true,  //
         "ajax":{
            url:"http://localhost/erp/pages/scripts/customer/manage.php",
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
      customerTable.on('click','.edit',function(e){
         $id = $(this).attr('id');
         $("#edit_customer_id").val($id);
         $.ajax({
            url:"http://localhost/erp/pages/scripts/customer/fetch.php",
            method:"POST",
            data:{customer_id:$id},
            dataType:"json",
            success:function(data){
               $("#customer_name").val(data.customer_name);
               $("#customer_address").val(data.customer_address);
               $("#customer_contact").val(data.customer_contact);
               $("#customer_email").val(data.customer_email);
               $("#gst_no").val(data.gst_no);
               $("#editModal").modal('show');
            },
         });
      });
      customerTable.on('click','.delete',function(e){
         $id = $(this).attr('id');
         $("#recordID").val($id);
      });
   }
   return{
      //Main function in javascript to handle all the initialisation part 
      init: function(){
         handleCustomerTable();
      }
   };
}();
jQuery(document).ready(function(){
   TableDatatables.init();
});