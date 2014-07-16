<form action="{BASE_URL}/pages/edit_process/{id_page}" method="post" class="mainForm">
	<fieldset>
    <div class="widget first">
			<div class="head">
			  <h5>{lang_edit_page}{title}</h5>
		  </div>
    	<div class="rowElem nobg">
      	<label>{lang_title_field}<span class="req" >*</span></label>
        <div class="formRight">
        	<input type="text" name="title" id="title" value="{title}"/>
        </div>
        <div class="fix"></div>
      </div>

			<div class="rowElem nobg">
      	<label>{lang_content_type_field}</label>
				<div class="formRight noSearch">
					<select name="modules" class="chzn-select" id="modules" >
						{MODULES}
						<option value="{module_slug}" {selected}>{name}</option>
						{/MODULES}
					</select>
				</div>
			  <div class="fix"></div>
		  </div>

 	    <div id="normal_content">
      	<label id="ckeditor">{lang_content_field}</label><br />
        <p id="ckeditor-arange">
          <textarea class="ckeditor" cols="80" id="editor1" name="content" rows="10">{content}</textarea>
        </p>
      </div>
	  </div>

    <div class="widget">
      <div class="head">
				<h5>{lang_menu_options}</h5>
			</div>

    	<div class="rowElem nobg">
      	<label>{lang_page_type_field}</label>
      	<div class="formRight noSearch">
        	<select name="page_type"  class="chzn-select" id="page_type" >
         		<option value="parent">{lang_default_page_type_value}</option>
            <option value="parent-no-link" {parent_no_link}>{lang_empty_page_type_value}</option>
            {PAGE_TYPE}
          	<option value="{id_page}" {selected}>{title}</option>
            {/PAGE_TYPE}
        	</select>
       	</div>
      	<div class="fix"></div>
     	</div>
    </div>

    <div class="widget">
      <div class="head">
        <h5>{lang_sidebar_options}</h5>
      </div>
      <div class="rowElem">
        <label class="sidebar_style">{lang_sidebars_style}</label>
        <div class="formRight noSearch">
          <select name="sidebar_style" class="chzn-select"  id="sidebar_style" >
            {SIDEBARS_STYLE}
            <option value="{value}" {selected}>{name}</option>
            {/SIDEBARS_STYLE}
          </select>
        </div>

        <label id="left_sidebar" class="sidebar_style {show_left_sidebar}">{lang_sidebar_name_left}</label>
        <div class="formRight noSearch {show_left_sidebar}" id="sidebar_name_left">
          <select name="sidebar_left" class="chzn-select" id="sidebar_name_left">
              {SIDEBARS_left}
                <option value="{id_sidebar}">{name}</option>
              {/SIDEBARS_left}
          </select>
        </div>

        <label id="right_sidebar" class="sidebar_style {show_right_sidebar}">{lang_sidebar_name_right}</label>
        <div class="formRight noSearch {show_right_sidebar}" id="sidebar_name_right">
          <select name="sidebar_right" class="chzn-select">
            {SIDEBARS_right}
              <option value="{id_sidebar}">{name}</option>
            {/SIDEBARS_right}
          </select>
        </div>
        <div class="fix"></div>
      </div>
    </div>

    <div class="widget">
			<div class="rowElem">
				<label class="allRequired"> * {lang_required_fields}</label>
				<div class="formRight submitRight">
					<input type="submit" value="{lang_submit_form}" class="basicBtn edit" id="submitPages" />
				</div>
				<div class="fix"></div>
			</div>
		</div>
 	</fieldset>
</form>
