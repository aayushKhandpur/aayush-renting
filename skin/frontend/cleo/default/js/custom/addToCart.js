   jQuery(document).ready(function () {
     var rentType =jQuery("#renttype").val();
     var val =  Number(jQuery("#mintime").val() );

                 jQuery('#fromdate').datepicker({

                     autoclose:true,
                     format:"dd-mm-yyyy",
                     startDate:new Date(),
                     todayHighlight:true,
                 });

              jQuery('#todate').datepicker({

                autoclose:true,
                format:"dd-mm-yyyy",
                startDate:setToDate(new Date()),
                todayHighlight:true,
              });
              function setToDate(fromDate){

                 var day=1;
                if(rentType=="Per Month"){
                    day=30;
                 }
              var   toDate = fromDate.getTime()  + val*day*24*60*60*1000;
                 return new Date(toDate);
              };
            jQuery("#fromdate").datepicker("setDate", new Date());
            jQuery("#todate").datepicker("setDate",setToDate(new Date()) );

          });
