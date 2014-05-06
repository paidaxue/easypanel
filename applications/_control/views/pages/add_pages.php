<form action = "{BASE_URL}/pages/add_process" method = "post" class = "mainForm" >

	<fieldset>

  	<div class="widget first">

			<div class="head">

			  <h5>{lang_add_new_page}</h5>

		  </div><!-- .head -->

    	<div class="rowElem nobg">

      	<label>{lang_title_field}<span class = "req" >*</span></label>

          <div class="formRight">

          	<input type="text" name="title" id="title"/>

            </div><!-- .formRight -->

          <div class="fix"></div>

      </div><!-- .rowElem -->

			<div class="rowElem nobg">

        <label>{lang_content_type_field}</label>

          <div class="formRight noSearch">

            <select name="modules" class = "chzn-select" id = "modules" >

  						{MODULES}
                <option value="{nickname}">{name}</option>
  						{/MODULES}

            </select>

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

    <div class="widget">

      <div class="head">

		    <h5>{lang_menu_options}</h5>

	    </div><!-- .widget -->

    	<div class="rowElem nobg">

      	<label>{lang_page_type_field}</label>

      	<div class="formRight noSearch">

        	<select name="page_type"  class = "chzn-select" id = "page_type" >

            <option value="1">{lang_default_page_type_value}</option>
          	<option value="0">{lang_empty_page_type_value}</option>
              {PAGE_TYPE}
          	<option value="{id_page}">{title}</option>
              {/PAGE_TYPE}

        	</select>

       	</div><!-- .formRight -->

      	<div class="fix"></div>

     	</div><!-- .rowElem -->

    </div><!-- .widget -->


    <div class = "widget">
      <div class="head">

        <h5>{lang_sidebar_options}</h5>

      </div><!-- .widget -->
      <div class="rowElem">

        <label class = "sidebar_style">{lang_sidebars_style}</label>
        <div class="formRight noSearch">
          <select name="sidebar_style" class = "chzn-select"  id = "sidebar_style" >
              <option value="none">{lang_sidebar_none}</option>
              <option value="left">{lang_sidebar_left}</option>
              <option value="right">{lang_sidebar_right}</option>
              <option value="both">{lang_sidebar_both}</option>
          </select>
        </div>

        <label id="left_sidebar" class = "sidebar_style">{lang_sidebar_name_left}</label>
        <div class="formRight noSearch" id="sidebar_name_left">
          <select name="sidebar_left" class = "chzn-select"  id = "sidebar_name_left" >
              {SIDEBARS}
                <option value="{id_sidebar}">{name}</option>
              {/SIDEBARS}
          </select>
        </div>

        <label id="right_sidebar" class = "sidebar_style">{lang_sidebar_name_right}</label>
        <div class="formRight noSearch" id="sidebar_name_right">
          <select name="sidebar_right" class = "chzn-select">
              {SIDEBARS}
                <option value="{id_sidebar}">{name}</option>
              {/SIDEBARS}
          </select>
        </div>
        <div class="fix"></div>

      </div><!-- .rowElem -->

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