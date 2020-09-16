<div id="ctl00_MasterPageUpdatePanel">

       <input name="ctl00$1811910635" type="hidden" id="ctl00_1811910635" value="test">

    <script type="text/javascript">


        var canSubmit;

        function OnExitInvoiceId(invoiceIDControl) {
             var patt = new RegExp('^[\\-_0-9a-zA-Z\\!\\%\\&\\@\\#\\[\\]\\^\\$\\,\\|\\?\\*\\+\\(\\)]*$');
            //alert(itemIDControl.value);
             if (!patt.test(invoiceIDControl.value)) {
                 alert("Your Invoice ID cannot contain spaces");
                 invoiceIDControl.value = '';
                 invoiceIDControl.focus();
                 return false;
             }
             else {
                 return true;
             }


        }

        function CheckInvoiceId() {
            var invoiceIdTextBox = document.getElementById("ctl00_ContentPlaceHolder1_InvoiceIDTextBox");
            return OnExitInvoiceId(invoiceIdTextBox);

        }


    function Count(textControl,long)
    {

       var maxlength = new Number(long); // Change number to your max length.

       if (textControl.value.length > maxlength) {

           //textControl.value = textControl.value.substring(0, maxlength);
           alert(" Comments can have maximum of 200 characters ");
           return false;
       }

       return true;


   }


   function CheckCommentsCharacterCount() {
       var commentsTextBox = document.getElementById("ctl00_ContentPlaceHolder1_CommentsTextBox");
       if (commentsTextBox.value.length > 200) {
           return false;
       }
       else {
           return true;
       }
   }

   function CheckOtherCostCommentsCharacterCount() {
       var commentsTextBox = document.getElementById("ctl00_ContentPlaceHolder1_OtherCostDescriprtionTextBox");
       if (commentsTextBox.value.length > 200) {
           return false;
       }
       else {
           return true;
       }
   }

      function JustClose() {
            $find('SearchedNothineMessageModalPopupExtender').hide();
            var clientStoreIDTextBox = document.getElementById("ctl00_ContentPlaceHolder1_ClientStoreIDTextbox");
            clientStoreIDTextBox.focus();
            return false;
        }
    function invoiceDateClientValidator(sender, args) {
        if (args.Value == '') {
            args.IsValid = false;
            return false;
        }
        else {

            if (!checkInvoiceDate) {
                args.IsValid = false;
                return false;
            }
            else {
                args.IsValid = true;
                return true;
            }
        }
    }

    function checkInvoiceDate(dateValue) {

        var validformat = /^\d{2}\/\d{2}\/\d{4}$/ //Basic check for format validity

       if (!validformat.test(dateValue)) {

            return false;

        }

        var monthfield = input.value.split("/")[0]
        var dayfield = input.value.split("/")[1]
        var yearfield = input.value.split("/")[2]
        var dayobj = new Date(yearfield, monthfield - 1, dayfield)
        if ((dayobj.getMonth() + 1 != monthfield) || (dayobj.getDate() != dayfield) || (dayobj.getFullYear() != yearfield)) {
            return false;
        }

        else {
            if (dayobj > new Date()) {

                return false;
            }
            else {
                return true;
            }
        }


    }

    function CheckForFutureDate(sender, args) {

         var selectedDate = new Date();

        selectedDate = sender._selectedDate;

        var todayDate = new Date();

        if (selectedDate.getDateOnly() > todayDate.getDateOnly()) {

//           sender._selectedDate = '';
           //sender._textbox.set_Value('');
            var invoiceDateTextBox = document.getElementById('ctl00_ContentPlaceHolder1_InvoiceDateTextBox');
            invoiceDateTextBox.value = '';
            invoiceDateTextBox.focus();
            // alert(invoiceDateTextBox);
           // var invoiceDateCustomValidatorSPan = document.getElementById('ctl00_ContentPlaceHolder1_InvoiceDateCustomValidator');
            //invoiceDateCustomValidatorSPan.IsValid = false;
            //ValidatorValidate(invoiceDateCustomValidatorSPan)
            //ValidatorEnable(invoiceDateCustomValidatorSPan, true);
            alert('Invoice Date cannot be a future date');


      }
    }
    function OnExitStateDropDown(control) {
        var customerFirstNameTextBox = document.getElementById('ctl00_ContentPlaceHolder1_CustomerFirstNameTextBox');
        customerFirstNameTextBox.focus();

    }
    function OnExitSubmitterLastName(control) {
       // alert('OnExitSubmitterLastName');
        var inputControls = document.getElementsByTagName("input");
        // alert(inputControl.length);
        var totalMerchandiseCost = 0;
        for (var i = 0; i < inputControls.length; i++) {
            var controlID = inputControls.item(i).id;

            if (controlID.indexOf("ItemIDTextBox", 0) != -1) {
                inputControls.item(i).focus();
                break;

            }
        }

    }
    function RoundOffTheValue(control, roundingNumber) {
        if ((control.value != undefined) && (control.value != '') && !isNaN(control.value)) {

            var controlValue = new Number(control.value);
            control.value = controlValue.toFixed(roundingNumber);

        }
    }
    function OnEnterAndExitUnitPrice(control) {


        RoundOffTheValue(control, 2);

        var unitPriceValue = control.value;

        var discountTextBoxID = control.id.replace("UnitPrice", "Discount");
        var discountTextBox = document.getElementById(discountTextBoxID);
        var discountValue = discountTextBox.value;

        var quantityTextBoxID = control.id.replace("UnitPrice", "Quantity");
        var quantityTextBox = document.getElementById(quantityTextBoxID);
        var quantityValue = quantityTextBox.value;


        SetRACACostAndTotals(control, "UnitPrice", unitPriceValue, discountValue, quantityValue);

        //ctl00_ContentPlaceHolder1_uc0_UnitPriceTextBox
    }

    function OnEnterAndExitDiscount(control) {
        //alert(control.value);

         var patt = new RegExp('^[.0-9]+$');

         if (control.value != '00.00' && control.value.trim().length > 0) {
             if (!patt.test(control.value))
             {
                 alert('Discount has to be numeric and greater than zero.');
                 control.value = '';
             }

           }


        RoundOffTheValue(control, 2);

        var discountValue = control.value;

        var unitPriceTextBoxID = control.id.replace("Discount", "UnitPrice");
        var unitPriceTextBox = document.getElementById(unitPriceTextBoxID);
        var unitPriceValue = unitPriceTextBox.value;

        var quantityTextBoxID = control.id.replace("Discount", "Quantity");
        var quantityTextBox = document.getElementById(quantityTextBoxID);
        var quantityValue = quantityTextBox.value;


        SetRACACostAndTotals(control, "Discount", unitPriceValue, discountValue, quantityValue);

    }

    function OnExitQty(control) {

        OnEnterQuantity(control);
        var controlID = new String(control.id);
        var indexQuantityTextBox = controlID.indexOf("QuantityTextBox", 0);

        var controlID_1 = new String(controlID.substr(indexQuantityTextBox - 6, 5));
        //alert(controlID.substr(indexQuantityTextBox - 6, 5));
        // var indexQtyControl =  new Math(


        var nextControlVal = parseInt(controlID_1.substr(3, 2)) + 1;
        var nextControlVal1 = new String(nextControlVal);
        if (nextControlVal1.length == 1) {
            nextControlVal1 = '0' + nextControlVal;
        }
        var replaceVal = controlID_1.replace(controlID_1.substr(3, 2), nextControlVal1);
        //alert(controlID);
        var nextRowQtyControl = controlID.replace(controlID_1, replaceVal); ;
        var nextRowItemIDControlId = nextRowQtyControl.replace("QuantityTextBox", "ItemIDTextBox");
        //   alert(nextRowItemIDControlID);

        var nextRowItemIDControl = document.getElementById(nextRowItemIDControlId);
        if (nextRowItemIDControl)
            nextRowItemIDControl.focus();
        else {
            var deliveryFeeTotalTextBox = document.getElementById('ctl00_ContentPlaceHolder1_DeliveryFeeTotalTextBox');
            deliveryFeeTotalTextBox.focus();
        }
    }
    function OnEnterQuantity(control) {


        RoundOffTheValue(control, 0);

        var quantityValue = control.value;

        var unitPriceTextBoxID = control.id.replace("Quantity", "UnitPrice");
        var unitPriceTextBox = document.getElementById(unitPriceTextBoxID);
        var unitPriceValue = unitPriceTextBox.value;

        var discountTextBoxID = control.id.replace("Quantity", "Discount");
        var discountTextBox = document.getElementById(discountTextBoxID);
        var discountValue = discountTextBox.value;


        SetRACACostAndTotals(control, "Quantity", unitPriceValue, discountValue, quantityValue);
    }




 </script>
    <script type="text/javascript">

        function JustBeforeServerSubmit() {
            //alert('ddd');
            //alert($("#ctl00_ContentPlaceHolder1_StateDropDownList1"));
            //alert($("#ctl00_ContentPlaceHolder1_StateDropDownList1 option:selected").text());

            var stateDropDown = document.getElementById('ctl00_ContentPlaceHolder1_StateDropDownList1');

            //alert(stateDropDown.options[stateDropDown.selectedIndex].value.length);
            //alert(document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value);
            var custcity = document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox');
           // alert(custadd1.value);
           // alert(custadd1.value.length);

            var issueWithCustomerDeliveryAddress = false;
            var customerDeliverAddressAlert = 'Either enter all the Customer Delivery  address fields (address 2  & zipcode is optional) or do not enter any of them.';

            if ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value.length > 0) || (document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress2').value.length > 0) || ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value.length > 0) && (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value != 'City')) || (stateDropDown.options[stateDropDown.selectedIndex].value.length > 0) || ((document.getElementById('ctl00_ContentPlaceHolder1_CustomreZip').value.length > 0) && (document.getElementById('ctl00_ContentPlaceHolder1_CustomreZip').value != 'ZipCode')))
             {


                 if ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value.length > 0) && ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value == 'City') || (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value.length == 0) || (stateDropDown.options[stateDropDown.selectedIndex].value.length == 0) ))
                 {
                    // alert('add1');
                     issueWithCustomerDeliveryAddress = true;
                     alert(customerDeliverAddressAlert);;
                 }

                 else if ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress2').value.length > 0) && ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value.length == 0) || (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value == 'City') || (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value.length == 0) || (stateDropDown.options[stateDropDown.selectedIndex].value.length == 0) ))
                 {
                     //alert('add2');
                     issueWithCustomerDeliveryAddress = true;
                     alert(customerDeliverAddressAlert); ;
                 }

                else if (((document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value != 'City') && (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value.length > 0)) && ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value.length == 0) || (stateDropDown.options[stateDropDown.selectedIndex].value.length == 0) ))
                 {
                    // alert('city')
                     issueWithCustomerDeliveryAddress = true;
                     alert(customerDeliverAddressAlert);
                 }
                else if ((stateDropDown.options[stateDropDown.selectedIndex].value.length > 0) && ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value.length == 0) || (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value == 'City') || (document.getElementById('ctl00_ContentPlaceHolder1_CustomerCityTextBox').value.length == 0) ))
                {
                    //alert('state');
                    issueWithCustomerDeliveryAddress = true;
                    alert(customerDeliverAddressAlert); ;
                }

                else if ( (document.getElementById('ctl00_ContentPlaceHolder1_CustomreZip').value != 'ZipCode')  &&  (document.getElementById('ctl00_ContentPlaceHolder1_CustomreZip').value.length > 0 ))
                {

                    //alert('zip');

                    var zip = new RegExp("^\\d{5}(-\\d{4})?$");

                    if (!zip.test(document.getElementById('ctl00_ContentPlaceHolder1_CustomreZip').value.trim())) {
                        //alert(document.getElementById('ctl00_ContentPlaceHolder1_CustomreZip').value);
                        issueWithCustomerDeliveryAddress = true;
                        alert('Please enter a valid 5 digit zip code.');
                    }
                    else if ((document.getElementById('ctl00_ContentPlaceHolder1_CustomerDelAddress1').value.length == 0)) {
                        //alet('alldone');
                        issueWithCustomerDeliveryAddress = true;
                        alert(customerDeliverAddressAlert); ;

                    }


                }

            }

            if (issueWithCustomerDeliveryAddress)
                return false;

            UpdateTotals();
            SetStoresFormFields(false);

            if (!CheckInvoiceId()) {
                return false;
            }
            var hiddenInvoiceCost = document.getElementById('ctl00_ContentPlaceHolder1_HiddenInvoiceCost');
            var totalInvoiceValue = parseFloat(hiddenInvoiceCost.value);
            if(!isNaN(totalInvoiceValue))
            {
                if (totalInvoiceValue > 99999.99 || totalInvoiceValue <  -99999.99)
               {
                   alert("Your total invoice cost cannot exceed (+/-)$99,999.99. Please review and modify your costs.");
                 return false;
               }
         }
             //alert('ff');
         if (!CheckCommentsCharacterCount()){
             alert(" Comments cannot exceed 200 characters. Please review and modify your comments");
                return false;
            }
            if (!CheckOtherCostCommentsCharacterCount()) {
                alert(" Other cost description cannot exceed 200 characters. Please review and modify your other cost description");
                return false;
            }


//            var invoiceDateCustomValidatorSPan = document.getElementById('ctl00_ContentPlaceHolder1_InvoiceDateCustomValidator');
//            ValidatorEnable(invoiceDateCustomValidatorSPan, false);
            return true;
        }
        function ClearStoresFormFields() {

            var clientStoreID = document.getElementById("ctl00_ContentPlaceHolder1_ClientStoreIDTextbox");
            var clientName = document.getElementById("ctl00_ContentPlaceHolder1_StoreNameTextBox");
            var racaStoreID = document.getElementById("ctl00_ContentPlaceHolder1_RACAStoreIDTextBox");
            var address = document.getElementById("ctl00_ContentPlaceHolder1_StreetTextBox");
            var city = document.getElementById("ctl00_ContentPlaceHolder1_CityTextBox");
            var state = document.getElementById("ctl00_ContentPlaceHolder1_StateDropDownList");

            clientStoreID.value = '';
            clientStoreID.disabled = false;

            clientName.value = '';
            clientName.disabled = false;

            racaStoreID.value = '';
            racaStoreID.disabled = false;

            address.value = '';
            address.disabled = false;

            city.value = '';
            city.disabled = false;

            //alert(state);
            state.value = '';
            state.disabled = false;



            return false;

        }
        function SetStoresFormFields( disabled) {

            //alert(disabled);
            var clientStoreID = document.getElementById("ctl00_ContentPlaceHolder1_ClientStoreIDTextbox");
            var clientName = document.getElementById("ctl00_ContentPlaceHolder1_StoreNameTextBox");
            var racaStoreID = document.getElementById("ctl00_ContentPlaceHolder1_RACAStoreIDTextBox");
            var address = document.getElementById("ctl00_ContentPlaceHolder1_StreetTextBox");
            var city = document.getElementById("ctl00_ContentPlaceHolder1_CityTextBox");
            var state = document.getElementById("ctl00_ContentPlaceHolder1_StateDropDownList");

              clientStoreID.disabled = disabled;
               clientName.disabled = disabled;
               racaStoreID.disabled = disabled;
               address.disabled = disabled;
               city.disabled = disabled;
               state.disabled = disabled;
               //alert(address.value);


            return true;

        }
        function OnItemCommandStoreControl(grid, itemIndex, colIndex, commandName) {

             // alert("OnItemCommandStoreControl-1");

              var item = grid.getItem(itemIndex);

              var clientStoreIDCell = item.getCell(1);
              var clientNameCell = item.getCell(2);
              var racaStoreIDCell = item.getCell(3);
              var addressCell = item.getCell(4);
              var cityCell = item.getCell(5);
              var stateCell = item.getCell(6)

              var clientStoreID = document.getElementById("ctl00_ContentPlaceHolder1_ClientStoreIDTextbox");
              var clientName = document.getElementById("ctl00_ContentPlaceHolder1_StoreNameTextBox");
              var racaStoreID = document.getElementById("ctl00_ContentPlaceHolder1_RACAStoreIDTextBox");
              var address = document.getElementById("ctl00_ContentPlaceHolder1_StreetTextBox");
              var city = document.getElementById("ctl00_ContentPlaceHolder1_CityTextBox");
              var state = document.getElementById("ctl00_ContentPlaceHolder1_StateDropDownList");




              if( clientStoreIDCell.getValue() != undefined)
               clientStoreID.value = clientStoreIDCell.getValue();
              clientStoreID.disabled = true;

              clientName.value = clientNameCell.getValue();
              clientName.disabled = true;

              racaStoreID.value = racaStoreIDCell.getValue();
              racaStoreID.disabled = true;

              address.value = addressCell.getValue();
              address.disabled = true;

              city.value = cityCell.getValue();
              city.disabled = true;

              //alert(state);
              state.value = stateCell.getValue();
              state.disabled = true;

              $find('SearchModalPopupExtender').hide();

        }

     function TestControlID(control) {

         //  alert(control.id);
         var ItemID = control.id;
         var ItemDescControlID = ItemID.replace('ID', 'Description');
         var ItemDescControl = document.getElementById(ItemDescControlID);
         alert(ItemDescControl.value);
      //   ctl00_ContentPlaceHolder1_InvoiceItem2_ItemDescriptionTextBox
     }

     function GetConfirmationMsgBox() {
         location.reload(true);
         return false;
     }

     function UpdateTotals() {
         //alert('ff');
         var inputControls = document.getElementsByTagName("input");
         // alert(inputControl.length);
         var totalMerchandiseCost = 0;
         for (var i = 0; i < inputControls.length; i++) {
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("RACACost", 0) != -1) {
                 // alert(inputControls.item(i).id);
                 // alert(inputControls.item(i).value);
                 var currentRowRACAValue = parseFloat(inputControls.item(i).value);
                 //alert(currentRowRACAValue);
//                 inputControls.item(i).value = RoundOffTheValue(inputControls.item(i).value, 2);
                 if (currentRowRACAValue > 0 || currentRowRACAValue < 0)
                     totalMerchandiseCost = (totalMerchandiseCost) + (currentRowRACAValue);
             }
         }

         var merchandiseTotalLabel = document.getElementById('ctl00_ContentPlaceHolder1_MerchandiseCostValueLabel');
         merchandiseTotalLabel.innerHTML =  '$' + totalMerchandiseCost.toFixed(2);

         var deliveryFeeTotalTextBox = document.getElementById('ctl00_ContentPlaceHolder1_DeliveryFeeTotalTextBox');
         var otherCostTextBox = document.getElementById('ctl00_ContentPlaceHolder1_OtherCostTextBox');




         var deliveryFeeValue = parseFloat(deliveryFeeTotalTextBox.value);

         var otherCostValue = parseFloat(otherCostTextBox.value);

         var totalInvoiceCost = 0;

         totalInvoiceCost = totalMerchandiseCost;

         if (!isNaN(deliveryFeeValue)) {
             //alert(deliveryFeeValue);
             totalInvoiceCost = totalInvoiceCost + deliveryFeeValue;
              RoundOffTheValue(deliveryFeeTotalTextBox, 2);
         }

         if (!isNaN(otherCostValue)) {
             totalInvoiceCost = totalInvoiceCost + otherCostValue;
             RoundOffTheValue(otherCostTextBox, 2);
         }

         var invoiceTotalLabel = document.getElementById('ctl00_ContentPlaceHolder1_InvoiceCostValueLabel');
         invoiceTotalLabel.innerHTML = '$' + totalInvoiceCost.toFixed(2);

         var hiddenMerchandiseCost = document.getElementById('ctl00_ContentPlaceHolder1_HiddenMerchandiseCost');
         var hiddenInvoiceCost = document.getElementById('ctl00_ContentPlaceHolder1_HiddenInvoiceCost');

         hiddenMerchandiseCost.value = totalMerchandiseCost;
         hiddenInvoiceCost.value = totalInvoiceCost;
//         alert(hiddenMerchandiseCost.value);
//         alert(hiddenInvoiceCost.value);


     }

     function SetRACACostAndTotals(control, replaceKey, unitPriceValue, discountValue, quantityValue) {

         var racaCostTextBoxID = control.id.replace(replaceKey, "RACACost");

         var racaCostTextBox = document.getElementById(racaCostTextBoxID);


//alert(racaCostHidden)

         // if unit price and quantity are numeric
         if (!isNaN(unitPriceValue) && !isNaN(discountValue) && !isNaN(quantityValue)) {
             //alert('all good');
             racaCostTextBox.value = (unitPriceValue - discountValue) * quantityValue;
             if (!isNaN(racaCostTextBox.value))
                 RoundOffTheValue(racaCostTextBox, 2);

             if (racaCostTextBox.value == '0.00') {
                 racaCostTextBox.value = '00.00';

             }
             //alert(racaCostTextBox.value);

         }

         UpdateTotals();



         //alert(merchandiseCostValueLabel.value);
     }

 </script>


<form method="POST" action="readxml.php">

 <div style="font-family:Arial; font-size:small">
    <div id="ctl00_ContentPlaceHolder1_AjaxcProgressControlID_ProgressingPanel" class="modalPopup2" style="height:130px;width:275px;display: none">




             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <img src="Images/Updating.gif"><br>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Processing ..please wait




	</div>
            <span id="ctl00_ContentPlaceHolder1_AjaxcProgressControlID_DLabel"></span>
  </div>

     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
  <table>
       <tbody><tr>
          <td width="50px">
               <table>
                     <tbody>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
               </tbody></table>
           </td>

       <td>  <table cellpadding="0" cellspacing="0" border="1" style="border-color:Black;" width="825px">
      <tbody><tr>
         <td>
             <table>
             <tbody><tr><td></td><td> <span id="ctl00_ContentPlaceHolder1_Label2" class="Label_Style5">Search For Your Store</span>  </td></tr>
                <tr>

                   <td>&nbsp;</td>


                    <td colspan="4" style="font-family:Arial; font-size:x-small">

                        Fill in any or all fields below to search for your store, then click "Search" . When you find your store in the list,
                        select it. The store information will be automatically added to your form. To start over, search for another store,
                         or click the "clear form" button.

                     </td>

                 </tr>
                 </tbody></table>
                 <table>
           <tbody><tr>  <td>
                     </td>
                                <td>&nbsp;</td>
                      <td>

                </td>  <td></td><td>

                      </td>
                 </tr>

                 <tr>

                    <td class="Label_Style4">
                        <span id="ctl00_ContentPlaceHolder1_ClientStoreIDLabel">Client Store ID</span>
                        <br>
                         <input name="ctl00$ContentPlaceHolder1$ClientStoreIDTextbox" type="text" maxlength="50" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$ClientStoreIDTextbox\',\'\')', 0)" onkeypress="if (WebForm_TextBoxKeyHandler(event) == false) return false;" id="ctl00_ContentPlaceHolder1_ClientStoreIDTextbox" class="TextBoxValue" style="width:160px;">


                    </td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td class="Label_Style4">
                       <span id="ctl00_ContentPlaceHolder1_RACAStoreIDLabel">A.N. Store ID</span> <font color="red"> *</font>
                       <br>
                       <input name="ctl00$ContentPlaceHolder1$RACAStoreIDTextBox" type="text" value="9647" maxlength="6" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$RACAStoreIDTextBox\',\'\')', 0)" onkeypress="if (WebForm_TextBoxKeyHandler(event) == false) return false;" id="ctl00_ContentPlaceHolder1_RACAStoreIDTextBox" class="TextBoxValue" style="width:160px;">
                       </td>

                       <td>&nbsp;&nbsp;&nbsp;</td>
                       <td class="Label_Style4">
                        <span id="ctl00_ContentPlaceHolder1_StoreNameLabel">Store Name</span> <font color="red">*</font>
                        <br>
                       <input name="ctl00$ContentPlaceHolder1$StoreNameTextBox" type="text" value="FURNITURE CONNECTION INC" maxlength="100" id="ctl00_ContentPlaceHolder1_StoreNameTextBox" class="TextBoxValue" style="width:160px;">

                    </td>
                 </tr>
                 <tr><td></td><td></td><td></td><td></td><td><span id="ctl00_ContentPlaceHolder1_Label4" style="font-size:XX-Small;"> (The name of your store)</span></td></tr>
                 </tbody></table>
                 <table>
                 <tbody><tr><td colspan="2">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;


                                </td></tr>
                  <tr>
                 <td class="Label_Style4" colspan="6"> <span id="ctl00_ContentPlaceHolder1_StoreBillingAddressLabel">Store's Billing Address</span>
                            <font color="red"> </font> <br>
                       <input name="ctl00$ContentPlaceHolder1$StreetTextBox" type="text" value="111 MERCHANTS BLVD" maxlength="50" id="ctl00_ContentPlaceHolder1_StreetTextBox" class="TextBoxValue" style="width:200px;">&nbsp;
                        <input name="ctl00$ContentPlaceHolder1$CityTextBox" type="text" value="CLARKSVILLE" maxlength="50" id="ctl00_ContentPlaceHolder1_CityTextBox" class="TextBoxValue" style="width:120px;">

                      <input type="hidden" name="ctl00$ContentPlaceHolder1$StreetTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_StreetTextBoxWatermarkExtender_ClientState">

                        <input type="hidden" name="ctl00$ContentPlaceHolder1$CityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_CityTextBoxWatermarkExtender_ClientState">

                           <select name="ctl00$ContentPlaceHolder1$StateDropDownList" id="ctl00_ContentPlaceHolder1_StateDropDownList" class="form_value" onblur="OnExitStateDropDown(this)">
		<option value="">Select...</option>
		<option value="AK">Alaska</option>
		<option value="AL">Alabama</option>
		<option value="AR">Arkansas</option>
		<option value="AZ">Arizona</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DC">District of Colombia</option>
		<option value="DE">Delaware</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="IA">Iowa</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="MA">Massachusetts</option>
		<option value="MD">Maryland</option>
		<option value="ME">Maine</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MO">Missouri</option>
		<option value="MS">Mississippi</option>
		<option value="MT">Montana</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="NE">Nebraska</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NV">Nevada</option>
		<option value="NY">New York</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="PR">Puerto Rico</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option selected="selected" value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VA">Virginia</option>
		<option value="VT">Vermont</option>
		<option value="WA">Washington</option>
		<option value="WI">Wisconsin</option>
		<option value="WV">West Virginia</option>
		<option value="WY">Wyoming</option>

	</select> &nbsp;&nbsp;
                </td>



                 </tr>



             </tbody></table>
          </td>
      </tr>
    </tbody></table>   </td>
       </tr>
  </tbody></table>





    <table>
       <tbody><tr>
           <td width="53px">
               <table>
                     <tbody>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                       <tr><td>&nbsp;</td></tr>
               </tbody></table>
           </td>


       <td>  <table cellpadding="0" cellspacing="0" border="1" style="border-color:Black;" width="825px">
      <tbody><tr>
         <td>
             <table>
                 <tbody><tr>
                    <td class="Label_Style5">&nbsp;&nbsp;Customer Information

                    </td>


                 </tr>
            <tr><td>


                     </td>
                      <td colspan="2">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;


                </td>
            </tr>

            <tr>
                    <td class="Label_Style4">

                       <span id="ctl00_ContentPlaceHolder1_CustomerFirstNameLabel">Customer First Name</span> <font color="red"> *</font><br>
                        <input name="ctl00$ContentPlaceHolder1$CustomerFirstNameTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_CustomerFirstNameTextBox" class="TextBoxValue" style="width:160px;">

                    </td>

                    <td class="Label_Style4">
                       <span id="ctl00_ContentPlaceHolder1_CustomerLastNameLabel">Customer Last Name</span> <font color="red"> *</font>
                       &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="ctl00_ContentPlaceHolder1_CustomerIDLabel">Customer ID</span> <font color="red"> </font>
                        <br>
                        <input name="ctl00$ContentPlaceHolder1$CustomerLastNameTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_CustomerLastNameTextBox" class="TextBoxValue" style="width:160px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="ctl00$ContentPlaceHolder1$CustomerIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_CustomerIDTextBox" class="TextBoxValue" style="width:160px;">
                    </td>
                 </tr>

            <tr><td class="Label_Style4">

                  <span id="ctl00_ContentPlaceHolder1_Label5">Customer Delivery  Address:</span>
                   <br>
                </td>
            </tr>


            <tr>
                    <td class="Label_Style4">

                       <span id="ctl00_ContentPlaceHolder1_lblCustAddr1"> Delivery Address 1</span> <br>
                        <input name="ctl00$ContentPlaceHolder1$CustomerDelAddress1" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_CustomerDelAddress1" class="TextBoxValue" style="width:160px;">

                    </td>

                    <td class="Label_Style4">
                       <span id="ctl00_ContentPlaceHolder1_lblCustAddr2"> Delivery Address 2</span>
                       &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <br>
                        <input name="ctl00$ContentPlaceHolder1$CustomerDelAddress2" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_CustomerDelAddress2" class="TextBoxValue" style="width:160px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </td>
                 </tr>



            <tr>
                    <td class="Label_Style4">

                       <span id="ctl00_ContentPlaceHolder1_lblCustCity"> City</span> <br>
                        <input name="ctl00$ContentPlaceHolder1$CustomerCityTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_CustomerCityTextBox" class="TextBoxValue" style="width:160px;">

                      <input type="hidden" name="ctl00$ContentPlaceHolder1$TextBoxWatermarkExtender1_ClientState" id="ctl00_ContentPlaceHolder1_TextBoxWatermarkExtender1_ClientState">

                        <input type="hidden" name="ctl00$ContentPlaceHolder1$TextBoxWatermarkExtender2_ClientState" id="ctl00_ContentPlaceHolder1_TextBoxWatermarkExtender2_ClientState">
                    </td>

                    <td class="Label_Style4">
                    <span id="ctl00_ContentPlaceHolder1_lblState"> State</span>
                       &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                        <span id="ctl00_ContentPlaceHolder1_lblZipCode">ZipCode</span>
                        <br>
                          <select name="ctl00$ContentPlaceHolder1$StateDropDownList1" id="ctl00_ContentPlaceHolder1_StateDropDownList1" class="form_value">
		<option selected="selected" value="">Select...</option>
		<option value="AK">Alaska</option>
		<option value="AL">Alabama</option>
		<option value="AR">Arkansas</option>
		<option value="AZ">Arizona</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DC">District of Colombia</option>
		<option value="DE">Delaware</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="IA">Iowa</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="MA">Massachusetts</option>
		<option value="MD">Maryland</option>
		<option value="ME">Maine</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MO">Missouri</option>
		<option value="MS">Mississippi</option>
		<option value="MT">Montana</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="NE">Nebraska</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NV">Nevada</option>
		<option value="NY">New York</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="PR">Puerto Rico</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VA">Virginia</option>
		<option value="VT">Vermont</option>
		<option value="WA">Washington</option>
		<option value="WI">Wisconsin</option>
		<option value="WV">West Virginia</option>
		<option value="WY">Wyoming</option>

	</select> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="ctl00$ContentPlaceHolder1$CustomreZip" type="text" maxlength="5" id="ctl00_ContentPlaceHolder1_CustomreZip" class="TextBoxValue" style="width:120px;">
                    </td>
                 </tr>





                 <tr><td width="180px" class="Label_Style6">



                  </td><td>


                        <span id="ctl00_ContentPlaceHolder1_InvoiceDateCustomValidator" class="Label_Style6" style="color:Red;display:none;"></span>
                     </td>
                 </tr>
                  <tr>
                 <td class="Label_Style4" colspan="6"> <span id="ctl00_ContentPlaceHolder1_InvoiceIDLabel">Invoice ID</span> <font color="red"> *</font>
                  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                  <span id="ctl00_ContentPlaceHolder1_InvoiceDateLabel">Invoice Date (Cannot be a future date.)</span> <font color="red"> *</font>
                  <br>
                       <input name="ctl00$ContentPlaceHolder1$InvoiceIDTextBox" type="text" maxlength="20" id="ctl00_ContentPlaceHolder1_InvoiceIDTextBox" class="TextBoxValue" onblur="OnExitInvoiceId(this)" style="width:160px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="ctl00$ContentPlaceHolder1$InvoiceDateTextBox" type="text" id="ctl00_ContentPlaceHolder1_InvoiceDateTextBox" class="TextBoxValue" style="width:160px;">
                        <img id="ctl00_ContentPlaceHolder1_CalenderImage" src="images/calender_img.jpg" style="border-width:0px;">&nbsp;

                                     <input type="hidden" name="ctl00$ContentPlaceHolder1$InvoiceDateTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_InvoiceDateTextBoxWatermarkExtender_ClientState">

                  </td>
                 </tr>
                 </tbody></table>
                 <table>
                <tbody><tr><td colspan="12"><hr width="780px"></td></tr>
                 </tbody></table>
                  <table>
                 <tbody><tr>
                 <td class="Label_Style5"> Submitter's Information<br>
                   <span id="ctl00_ContentPlaceHolder1_Label3" style="font-size:X-Small;font-weight:normal;">(Enter your first and last name below.)</span></td>
                 </tr>
                 <tr><td>   </td>
                      <td>

                      </td>
                      </tr>
                 <tr>
                 <td class="Label_Style4">

                       <span id="ctl00_ContentPlaceHolder1_SubmitterFirstNameLabel"> First Name</span> <font color="red"> *</font><br>
                        <input name="ctl00$ContentPlaceHolder1$SubmitterFirstNameTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_SubmitterFirstNameTextBox" class="TextBoxValue" style="width:160px;">

                    </td>

                    <td class="Label_Style4">
                       <span id="ctl00_ContentPlaceHolder1_SubmitterLastNameLabel"> Last Name</span> <font color="red"> *</font> <br>
                        <input name="ctl00$ContentPlaceHolder1$SubmitterLastNameTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_SubmitterLastNameTextBox" class="TextBoxValue" onblur="OnExitSubmitterLastName(this)" style="width:160px;">
                    </td>
                 </tr>
                <tr><td>&nbsp;</td></tr>
             </tbody></table>
          </td>
      </tr>
    </tbody></table>   </td>
       </tr>
  </tbody></table>

  <div style="font-family:Arial; font-size:small">

    <table>
        <tbody><tr> <td> &nbsp;</td>
        <td>  Enter information about the items being invoiced. If you are only invoicing Delivery Fees or Other Costs, go on to Step 4. </td>
        </tr>
        </tbody></table>
         <table>
          <tbody><tr> <td> &nbsp;</td>
             <td width="30px">&nbsp;</td>

             <td class="Label_Style4" width="690Px">
               <span id="ctl00_ContentPlaceHolder1_ItemIdMessageLabel1">Enter information in either Sections 3 or 4, or both. </span>
                 <span id="ctl00_ContentPlaceHolder1_ItemIdMessageLabel2">If you enter an Item ID Number in Section 3, then Item Description, Unit price and Quantity are also required fields.</span>
             </td>
        </tr>
    </tbody></table>
  </div>

   <table width="880px">
         <tbody><tr>
           <td width="60px">
               <table>
                     <tbody>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>

               </tbody></table>
           </td>

         <td>
         <div id="ctl00_ContentPlaceHolder1_UpdatePanel2">

 <table cellpadding="0" cellspacing="0">
   <tbody><tr>  <td> &nbsp;</td>
      <td> &nbsp;</td>
      <td width="118px"> &nbsp;&nbsp; </td>

      <td width="210px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </td>

      <td width="170px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </td>

      <td width="205px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

      <td width="185px"></td>
</tr>
  </tbody></table>
<table cellpadding="0" cellspacing="0" border="1">

<tbody><tr>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
    <td align="middle" class="Label_Style4" width="118px"><span id="ctl00_ContentPlaceHolder1_ItemIDLabel">Item ID Number</span> <font color="red"> *</font> </td>
    <td align="middle" class="Label_Style4" width="220px"><span id="ctl00_ContentPlaceHolder1_ItemDescriptionLabel">Item Description</span> <font color="red"> *</font></td>
    <td align="middle" class="Label_Style4" width="100px"> <span id="ctl00_ContentPlaceHolder1_UnitPriceLabel">Unit Price</span>   <font color="red"> *</font></td>
    <td align="middle" class="Label_Style4" width="205px"><span id="ctl00_ContentPlaceHolder1_DiscountLabel">     Discount Unit Amount</span>  <font color="red"> </font> </td>
    <td align="middle" class="Label_Style4" width="75px"> <span id="ctl00_ContentPlaceHolder1_QuantityLabel">Qty</span>  <font color="red"> *</font> </td>
    <td align="middle" class="Label_Style4" width="80px"> <span id="ctl00_ContentPlaceHolder1_RACACostLabel">A.N. Cost</span>  <font color="red"> *</font> </td>
 </tr>




 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl02$NumberTextBox" type="text" value="1" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl02_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl02$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl02_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl02$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl02_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl02$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl02_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl02$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl02_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl02$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl02_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl02$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl02_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl02$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl02_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl02$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl02_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl02$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl02_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl03$NumberTextBox" type="text" value="2" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl03_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl03$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl03_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl03$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl03_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl03$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl03_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl03$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl03_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl03$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl03_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl03$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl03_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl03$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl03_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl03$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl03_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl03$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl03_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl04$NumberTextBox" type="text" value="3" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl04_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl04$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl04_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl04$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl04_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl04$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl04_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl04$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl04_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl04$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl04_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl04$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl04_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl04$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl04_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl04$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl04_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl04$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl04_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl05$NumberTextBox" type="text" value="4" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl05_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl05$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl05_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl05$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl05_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl05$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl05_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl05$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl05_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl05$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl05_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl05$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl05_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl05$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl05_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl05$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl05_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl05$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl05_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl06$NumberTextBox" type="text" value="5" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl06_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl06$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl06_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl06$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl06_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl06$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl06_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl06$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl06_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl06$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl06_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl06$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl06_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl06$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl06_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl06$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl06_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl06$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl06_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl07$NumberTextBox" type="text" value="6" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl07_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl07$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl07_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl07$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl07_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl07$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl07_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl07$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl07_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl07$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl07_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl07$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl07_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl07$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl07_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl07$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl07_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl07$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl07_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl08$NumberTextBox" type="text" value="7" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl08_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl08$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl08_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl08$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl08_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl08$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl08_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl08$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl08_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl08$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl08_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl08$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl08_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl08$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl08_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl08$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl08_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl08$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl08_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl09$NumberTextBox" type="text" value="8" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl09_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl09$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl09_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl09$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl09_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl09$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl09_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl09$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl09_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl09$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl09_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl09$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl09_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl09$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl09_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl09$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl09_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl09$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl09_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl10$NumberTextBox" type="text" value="9" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl10_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl10$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl10_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl10$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl10_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl10$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl10_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl10$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl10_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl10$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl10_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl10$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl10_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl10$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl10_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl10$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl10_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl10$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl10_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>





 <script type="text/javascript">

     function OnExitItemID(itemIDControl) {
         var patt = new RegExp('^[0-9a-zA-Z]*$');
         //alert(itemIDControl.value);
         if (!patt.test(itemIDControl.value)) {
             alert("Your Item ID cannot contain spaces or special characters");
             itemIDControl.value = '';
             itemIDControl.focus();
             return;
         }
         validateItemID(itemIDControl);


     }

     function OnEnterItemID(itemIDControl) {
         validateItemID(itemIDControl);
     }

     function validateItemID(itemIDControl) {
         var inputControls = document.getElementsByTagName("input");

         for (var i = 0; i < inputControls.length; i++) {
             var control = inputControls.item(i);
             var controlID = inputControls.item(i).id;

             if (controlID.indexOf("ItemIDTextBox", 0) != -1) {

                 if (itemIDControl.id != controlID) {
                     if (itemIDControl.value != '' && itemIDControl.value == control.value) {
                         //itemIDControl.value
                         //                         alert(control.value);
                         alert('The Item ID ' + itemIDControl.value + ' is a duplicate Item ID. Please provide a unique item ID for each item entered.');
                         itemIDControl.value = '';
                         itemIDControl.focus();
                         break;
                     }
                 }
             }
         }
     }
  </script>


<tr>
<td>&nbsp;</td>

    <td align="middle" width="20px"> <input name="ctl00$ContentPlaceHolder1$ctl11$NumberTextBox" type="text" value="10" readonly="readonly" id="ctl00_ContentPlaceHolder1_ctl11_NumberTextBox" class="TextBoxValue" style="width:20px;"></td>
    <td align="middle" width="118px">  <input name="ctl00$ContentPlaceHolder1$ctl11$ItemIDTextBox" type="text" maxlength="50" id="ctl00_ContentPlaceHolder1_ctl11_ItemIDTextBox" class="TextBoxValue" onblur="OnExitItemID(this)" onfocus="OnEnterItemID(this)" style="width:120px;"> </td>
    <td align="middle" width="220px"><input name="ctl00$ContentPlaceHolder1$ctl11$ItemDescriptionTextBox" type="text" maxlength="300" id="ctl00_ContentPlaceHolder1_ctl11_ItemDescriptionTextBox" class="TextBoxValue" style="width:224px;"> </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl11$UnitPriceTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl11_UnitPriceTextBox" class="TextBoxValue" onchange="OnEnterAndExitUnitPrice(this)" onfocus="OnEnterAndExitUnitPrice(this)" style="width:100px;">
    <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl11$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl11_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="150px"> <input name="ctl00$ContentPlaceHolder1$ctl11$DiscountTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl11_DiscountTextBox" class="TextBoxValue" onchange="OnEnterAndExitDiscount(this)" onfocus="OnEnterAndExitDiscount(this)" style="width:150px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl11$DiscountTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl11_DiscountTextBoxWatermarkExtender_ClientState">
     </td>
    <td align="middle" width="75px"> <input name="ctl00$ContentPlaceHolder1$ctl11$QuantityTextBox" type="text" maxlength="3" id="ctl00_ContentPlaceHolder1_ctl11_QuantityTextBox" class="TextBoxValue" onblur="OnExitQty(this)" onfocus="OnEnterQuantity(this)" style="width:75px;">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$ctl11$QuantityTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_ctl11_QuantityTextBoxWatermarkExtender_ClientState">
      </td>
    <td align="middle" width="100px"> <input name="ctl00$ContentPlaceHolder1$ctl11$RACACostTextBox" type="text" id="ctl00_ContentPlaceHolder1_ctl11_RACACostTextBox" disabled="disabled" class="TextBoxValue" style="width:100px;">  </td>
 </tr>


</tbody></table>


 <input type="hidden" name="ctl00$ContentPlaceHolder1$currentHiddenLineItemNumber" id="ctl00_ContentPlaceHolder1_currentHiddenLineItemNumber" value="10">







	</div>
         </td>
         </tr>
   </tbody></table>


   <div style="font-family:Arial; font-size:small">

    <table>
        <tbody><tr> <td>&nbsp;</td>
        <td>  Costs and Totals </td>
        </tr>
    </tbody></table>
  </div>
  <table cellpadding="0" cellspacing="0" border="0">
        <tbody><tr>
            <td width="60px">
               <table>
                     <tbody>

                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
                      <tr><td>&nbsp;</td></tr>
               </tbody></table>
           </td>

            <td>
               <table cellpadding="0" cellspacing="0" border="1" style="border-color:Black;" width="825px">
                     <tbody><tr>
                         <td>
                            <table cellpadding="0" cellspacing="0" border="0">
                                     <tbody><tr>
                                          <td>
                                                 <table cellpadding="0" cellspacing="0" border="0">
             <tbody><tr><td>&nbsp;</td></tr>
             <tr>
               <td class="Label_Style7">
               <span id="ctl00_ContentPlaceHolder1_MerchandiseCostLabel">Merchandise Cost</span>
             </td>
             <td>
             &nbsp;  <span id="ctl00_ContentPlaceHolder1_MerchandiseCostValueLabel" class="Label_Style4" readonly="true" style="display:inline-block;font-family:Arial;width:90px;">$0.00</span>
             </td>
           </tr>
           <tr><td>&nbsp;</td>
           <td> &nbsp;&nbsp;&nbsp; </td>
           </tr>
           <tr>
               <td class="Label_Style7">
               <span id="ctl00_ContentPlaceHolder1_DeliveryFeeTotalLabel">Delivery Fee Total $</span>
             </td>
             <td>
             &nbsp; <input name="ctl00$ContentPlaceHolder1$DeliveryFeeTotalTextBox" type="text" id="ctl00_ContentPlaceHolder1_DeliveryFeeTotalTextBox" class="TextBoxValue" onblur="UpdateTotals()" style="width:90px;">
             <input type="hidden" name="ctl00$ContentPlaceHolder1$DeliveryFeeTotalTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_DeliveryFeeTotalTextBoxWatermarkExtender_ClientState">
             </td>
           </tr>
           <tr><td>&nbsp;</td><td> &nbsp;&nbsp;&nbsp; </td></tr>
           <tr>
               <td class="Label_Style7">
               <span id="ctl00_ContentPlaceHolder1_OtherCostLabel">Other Cost $</span>
             </td>
             <td>
            &nbsp; <input name="ctl00$ContentPlaceHolder1$OtherCostTextBox" type="text" id="ctl00_ContentPlaceHolder1_OtherCostTextBox" class="TextBoxValue" onblur="UpdateTotals()" style="width:90px;">
            <input type="hidden" name="ctl00$ContentPlaceHolder1$OtherCostTextBoxWatermarkExtender_ClientState" id="ctl00_ContentPlaceHolder1_OtherCostTextBoxWatermarkExtender_ClientState">
             </td>
           </tr>
           <tr><td>&nbsp;</td></tr>
           <tr>
               <td class="Label_Style7">
               <span id="ctl00_ContentPlaceHolder1_InvoiceCostLabel">Invoice Cost</span>
             </td>
             <td>
               &nbsp; <span id="ctl00_ContentPlaceHolder1_InvoiceCostValueLabel" class="Label_Style4" style="font-family:Arial;font-weight:bold;">$0.00</span>
               <input type="hidden"  id="ctl00_ContentPlaceHolder1_InvoiceCostValueLabel">
             </td>
           </tr>
          <tr><td>&nbsp;</td></tr>
        </tbody></table>
                                         </td>
                                          <td width="60px">&nbsp;&nbsp;&nbsp;</td>
                                          <td colspan="4"><div style="font-family:Arial; font-size:small"> If you have Other Costs, please provide a description.</div>

                                            <br>
                                          <textarea name="ctl00$ContentPlaceHolder1$OtherCostDescriprtionTextBox" rows="2" cols="20" id="ctl00_ContentPlaceHolder1_OtherCostDescriprtionTextBox" class="CommentTextBox" style="height:70px;width:400px;"></textarea>
                                      </td>
                                    </tr>
                           </tbody></table>
                         </td>
                   </tr>

            <tr><td>&nbsp;</td></tr>
        </tbody></table>
            </td>
       </tr>
  </tbody></table>

  <table>
        <tbody><tr>
            <td width="50px"> &nbsp;&nbsp;&nbsp;
            </td>
            <td class="Label_Style4"> Additional Comments <span id="ctl00_ContentPlaceHolder1_commentlabel" style="font-size:XX-Small;">(200 Character Max)</span></td>
        </tr>
        <tr>
        <td width="50px">&nbsp;</td>
        <td><textarea name="ctl00$ContentPlaceHolder1$CommentsTextBox" rows="2" cols="20" id="ctl00_ContentPlaceHolder1_CommentsTextBox" class="CommentTextBox" multipline="true" style="height:70px;width:815px;"></textarea> </td>
            </tr>

  </tbody></table>




<span id="ctl00_ContentPlaceHolder1_DummyControlID"></span>



       <div id="ctl00_ContentPlaceHolder1_SearchPanel" class="modalPopup2" style="height:360px;width:810px;display:none">




<script type="text/javascript">

    // watch this function
    function OnItemCommandStoreControl1(grid, itemIndex, colIndex, commandName) {
        alert('store control');
        var item = grid.getItem(itemIndex);
        var clientStoreIDCell = item.getCell(2);
        var clientName = item.getCell(3);
        var racaStoreID = item.getCell(4);
        var hightouchNumber = item.getCell(5);
        var address = item.getCell(8);
        var city = item.getCell(9);
        var state = item.getCell(10);
        $find('SearchModalPopupExtender').hide();

        if ($find('ProgressingPanelModalPopupExtender')) {
            $find('ProgressingPanelModalPopupExtender').show();
        }
        __doPostBack();




        //var storeText = document.getElementById('ClientNameTextBox');
        //alert(TextBox);
        // TextBox.value = clientName.getValue()
        // alert(TextBox);

    }

    function Cancel_Click() {


        $find('SearchModalPopupExtender').hide();
        return false;
    }

    function Cancel_ClickSelf() {


        $find('SearchStoreModalPopupExtender').hide();
        return false;
    }



</script>


     <div id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_UpdatePanel1">




      <div id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_TG1_progress1" style="display:none;">

              <div id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_TG1_pnlProgressBar">

                  <div style="font-family:Verdana; font-size:small; color:Gray;">
                      <img id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_TG1_Image1" src="Images/Loading.gif" style="border-width:0px;">
                    Please wait.
                  </div>

					</div>


				</div>

     <span id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_DisplayLabel" class="Label_Red"></span>



     <div id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_SearchCritetiaPanel">

     <div style="font-family:Arial; font-size:small"> Please fill in any or all of the form fields below.</div>

     <table>
     <tbody><tr>

          <td class="Label_Style2">
             <span id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_ClientLabel">Store Name</span> :
          </td>
          <td>
             <input name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$ClientNameTextBox" type="text" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_ClientNameTextBox" class="TextBoxValue">
          </td>
          </tr>
          <tr>
              <td class="Label_Style2"> <span id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_StreetAddressLabel">Street Address</span>  </td>
          <td> <input name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$StreetAddressTextBox" type="text" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_StreetAddressTextBox" class="TextBoxValue"></td>
           </tr>
           <tr>
                <td class="Label_Style2"> <span id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_CityLabel">City</span>  </td>
          <td> <input name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$CityTextBox" type="text" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_CityTextBox" class="TextBoxValue"></td>
           </tr>
           <tr><td class="Label_Style2">
               <span id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_StateLabel">State:</span>
              </td>
              <td>
                 <select name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$StateDropDownList" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_StateDropDownList" class="form_value">
						<option selected="selected" value="">Select...</option>
						<option value="AK">Alaska</option>
						<option value="AL">Alabama</option>
						<option value="AR">Arkansas</option>
						<option value="AZ">Arizona</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DC">District of Colombia</option>
						<option value="DE">Delaware</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="IA">Iowa</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="MA">Massachusetts</option>
						<option value="MD">Maryland</option>
						<option value="ME">Maine</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MO">Missouri</option>
						<option value="MS">Mississippi</option>
						<option value="MT">Montana</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="NE">Nebraska</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NV">Nevada</option>
						<option value="NY">New York</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="PR">Puerto Rico</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VA">Virginia</option>
						<option value="VT">Vermont</option>
						<option value="WA">Washington</option>
						<option value="WI">Wisconsin</option>
						<option value="WV">West Virginia</option>
						<option value="WY">Wyoming</option>

					</select>
              </td>
           </tr>
          <tr>
          <td class="Label_Style2">
            <span id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_RACAStoreIDLabel"> A.N. Store ID</span> :
          </td>
          <td>
           <input name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$RACAStoreIDTextBox" type="text" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_RACAStoreIDTextBox" class="TextBoxValue">
          </td>
          <td>
    <input type="image" name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$SearchImageButton" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_SearchImageButton" usesubmitbehavior="false" src="images/search_btn.gif" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$StoreLocationlookUp1$SearchImageButton&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" style="height:26px;width:95px;border-width:0px;">&nbsp;&nbsp;&nbsp;
    <input type="image" name="ctl00$ContentPlaceHolder1$StoreLocationlookUp1$CancelImageButton" id="ctl00_ContentPlaceHolder1_StoreLocationlookUp1_CancelImageButton" usesubmitbehavior="false" src="images/cancel_btn.gif" onclick="return Cancel_Click();WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ContentPlaceHolder1$StoreLocationlookUp1$CancelImageButton&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" style="height:26px;width:95px;border-width:0px;"> </td>
    </tr>

    </tbody></table>

				</div>



			</div>

		</div>



       <span id="ctl00_ContentPlaceHolder1_DummMessageLabel"></span>



       <div id="ctl00_ContentPlaceHolder1_SearchedNothingMessagePanel" class="modalPopup2" style="height:150px;width:320px;display:none">


              <br>
              <br>
              <table><tbody><tr>
                     <td>&nbsp;&nbsp;</td>
                     <td>  <span id="ctl00_ContentPlaceHolder1_SearchedNothingMessageLabel" class="Label_Style4"></span>
              <br><br> </td>
                     </tr>
             </tbody></table>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" name="ctl00$ContentPlaceHolder1$close" value="Close" onclick=" return JustClose();" id="ctl00_ContentPlaceHolder1_close">

		</div>





       <input type="hidden" name="ctl00$ContentPlaceHolder1$HiddenMerchandiseCost" id="ctl00_ContentPlaceHolder1_HiddenMerchandiseCost">
       <input type="hidden" name="ctl00$ContentPlaceHolder1$HiddenInvoiceCost" id="ctl00_ContentPlaceHolder1_HiddenInvoiceCost">


	</div>


<br>




</div>

<input type='submit' name='submit' value='submit'>


</form>
