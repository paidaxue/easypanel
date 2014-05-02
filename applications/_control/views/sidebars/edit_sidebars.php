<form action = "{BASE_URL}/sidebars/edit_process/{id_sidebar}" method="post" class="mainForm">

	<fieldset>

    <div class="widget first">

			<div class="head">

			  <h5>{lang_edit_page}{name}</h5>

		  </div><!-- .head -->

    	<div class="rowElem nobg">

      	<label>{lang_title_field}<span class = "req" >*</span></label>

        <div class="formRight">

        	<input type="text" name="title" id="title" value="{name}"/>

        </div><!-- .formRight -->

        <div class="fix"></div>

      </div><!-- .rowElem -->

			<div class="rowElem nobg">

				<div class="formRight noSearch">

				</div><!-- .formRight -->

			  <div class="fix"></div>

		  </div><!-- .rowElem -->

 	    <div id="normal_content">

      	<label id="wysiwyg-content">{lang_content_field}</label>
      	<textarea name="content" class="wysiwyg" id="wysiwyg" rows="5" cols="">{content}</textarea>

      </div><!-- #normal_content -->

	  </div><!-- .widget .first -->

    <div class = "widget">

			<div class="rowElem">

				<label class = "allRequired"> * {lang_required_fields}</label>

				<div class="formRight submitRight">

					<input type="submit" value="{lang_submit_form}" class="basicBtn edit" id = "submitPages" />

				</div><!-- .formRight -->

				<div class="fix"></div>

			</div><!-- .rowElem -->

		</div><!-- .widget -->

 	</fieldset>

</form>
