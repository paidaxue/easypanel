<form action = "{BASE_URL}/sidebars/add_procces" method = "post" class = "mainForm" >

	<fieldset>

  	<div class="widget first">

			<div class="head">

			  <h5>{lang_add_new_sidebar}</h5>

		  </div><!-- .head -->

    	<div class="rowElem nobg">

      	<label>{lang_title_field}<span class = "req" >*</span></label>

          <div class="formRight">

          	<input type="text" name="title" id="title"/>

            </div><!-- .formRight -->

          <div class="fix"></div>

      </div><!-- .rowElem -->

 	    <div id="normal_content">

      	<label id="ckeditor">{lang_content_field}</label><br />
        <p id="ckeditor-arange">
      	  <textarea name="content" class="ckeditor" id="editor1" rows="5" cols=""></textarea>
        </p>

      </div><!-- #normal_content -->

    </div><!-- .widget -->

		<div class = "widget">

			<div class="rowElem">

				<label class = "allRequired"> * {lang_required_fields}</label>

				<div class="formRight submitRight">

					<input type="submit" value="{lang_submit_form}" class="basicBtn" id = "submitPages" />

				</div><!-- .formRight -->

				<div class="fix"></div>

			</div><!-- .rowElem -->

		</div><!-- .widget -->

  </fieldset>

</form>