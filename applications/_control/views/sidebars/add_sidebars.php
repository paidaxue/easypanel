<form action="{BASE_URL}/sidebars/add_procces" method="post" class="mainForm" >
	<fieldset>
  	<div class="widget first">
			<div class="head">
			  <h5>{lang_add_new_sidebar}</h5>
		  </div>

    	<div class="rowElem nobg">
      	<label>{lang_title_field}<span class="req" >*</span></label>
        <div class="formRight">
        	<input type="text" name="title" id="title"/>
        </div>

        <div class="fix"></div>
      </div>

    	<label>{lang_content_field}</label><br />
  	  <textarea class="js-trumbowyg" name="content"></textarea>
    </div>

		<div class="widget">
			<div class="rowElem">
				<label class="allRequired"> * {error_required_fields}</label>
				<div class="formRight submitRight">
					<input type="submit" value="{lang_submit_form}" class="basicBtn" id="submitPages" />
				</div>
				<div class="fix"></div>
			</div>
		</div>
  </fieldset>
</form>