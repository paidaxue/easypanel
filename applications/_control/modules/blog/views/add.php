<form action="{BASE_URL}/blog/add_process" method="post" class="mainForm" enctype="multipart/form-data">
	<fieldset>

  	<div class="widget first">
			<div class="head">
			  <h5>{lang_page_title}</h5>
		  </div><!-- .head -->
    	<div class="rowElem nobg">
      	<label>{lang_title_field}</label>
          <div class="formRight">
          	<input type="text" name="title"/>
          </div><!-- .formRight -->
          <div class="fix"></div>
      </div><!-- .rowElem -->
      <div class="rowElem nobg">
        <label>{lang_image_field}</label>
          <div class="formRight">
            <input type="file" name="image"/>
          </div><!-- .formRight -->
          <div class="fix"></div>
      </div><!-- .rowElem -->
 	    <div id="normal_content">
      	<label id="ckeditor">{lang_content_field}</label><br />
        <p id="ckeditor-arange">
          <textarea class="ckeditor" cols="80" id="editor1" name="content" rows="10"> </textarea>
        </p>
      </div><!-- #normal_content -->
    </div><!-- .widget -->

		<div class = "widget">
			<div class="rowElem">
				<div class="formRight submitRight">
					<input type="submit" value="{lang_submit_form}" class="basicBtn"/>
				</div><!-- .formRight -->
				<div class="fix"></div>
			</div><!-- .rowElem -->
		</div><!-- .widget -->

  </fieldset>
</form>