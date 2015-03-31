<form action="{BASE_URL}/sidebars/edit_process/{id_sidebar}" method="post" class="mainForm">
	<fieldset>
    <div class="widget first">
			<div class="head">
			  <h5>{lang_edit_sidebar}{name}</h5>
		  </div>

    	<div class="rowElem nobg">
      	<label>{lang_title_field}<span class="req" >*</span></label>
        <div class="formRight">
        	<input type="text" name="title" id="title" value="{name}"/>
        </div>

        <div class="fix"></div>
      </div>

			<div class="rowElem nobg">
				<div class="formRight noSearch">
				</div>

        <div class="fix"></div>
		  </div>

    	<label>{lang_content_field}</label><br />
  	  <textarea class="js-trumbowyg" name="content">{content}</textarea>
	  </div>

    <div class="widget">
			<div class="rowElem">
				<label class="allRequired"> * {edit_required_fields}</label>
				<div class="formRight submitRight">
					<input type="submit" value="{lang_submit_form}" class="basicBtn edit" id="submitPages" />
				</div>

				<div class="fix"></div>
			</div>
		</div>
 	</fieldset>
</form>
