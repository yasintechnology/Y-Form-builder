<div class="main-wrapper" >

<div class="widget-left-input">

    <input type="text" class='input-f-title' id="yform_title" name="checkbox4" placeholder="Form Title" />

    <div id="in-message"></div>
    <input type="button" class="add-input" value="Click To Add Text Field" onClick="addtextbox()">
    <input type="button" class="add-input" value="Click To Add Submit" onClick="addsubmit()">     

 <div class="widget-right-method" >
<br>
 <i> Plase Select A Method For Form</i>
<div id="toggles">

    <input type="checkbox" name="checkbox1" id="checkbox2" class="ios-toggle" checked/>
    <label for="checkbox2" class="checkbox-label" data-off="not save, just email" data-on="yes, save in admin"></label>

    <input type="checkbox" name="checkbox1" id="checkbox3" class="ios-toggle" checked/>
    <label for="checkbox3" class="checkbox-label" data-off="not send to email" data-on="yes, send to email"></label>


</div>


</div>

<input type="button"  class="save-yfb save-form" value="Save Form" onClick="changeIt2()" />
</div>
</div>

    <div style="display:none;" id="loadingfmessage"><img src="<?php echo esc_url(plugins_url('/../img/loading-admin.gif',__FILE__)); ?>" alt="loading" /> </div>
    <div id="ajax-response-adminf"> </div>

<div class="Field-Entry">
            <i style="float:left;width:100%"> Field Entry Place</i>
<div style="float:left;width:180px" id="createTextbox"></div>
<div style="float:left;width:140px;" id="options"></div>
</div>




