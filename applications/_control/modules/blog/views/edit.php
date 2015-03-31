<form action="{BASE_URL}/blog/edit_process/{id_post}" method="post" class="mainForm" enctype="multipart/form-data">
	<fieldset>

  	<div class="widget first">
			<div class="head">
			  <h5>{lang_page_title}</h5>
		  </div><!-- .head -->
    	<div class="rowElem nobg">
      	<label>{lang_title_field}</label>
        <div class="formRight">
        	<input type="text" name="title" value="{title}"/>
        </div><!-- .formRight -->
        <div class="fix"></div>
      </div><!-- .rowElem -->
      <div class="rowElem nobg">
        <label>{lang_image_field}</label>
        <div class="formRight">
          <div class="pics single">
             <ul>
              <li>
                <a href="#" class = "img">
                  <img src="{UP_URL}/blog/{image}" alt="Image" />
                </a>
                <div class="actions">
                  <a href="#" title="">
                    <img src="{APP_URL}/images/edit.png" alt="Edit button" />
                    <input type="file" name="image" class="default" />
                  </a>
                </div>
              </li>
            </ul>
          </div><!-- .pics -->
        </div>
        <div class="fix"></div>
      </div><!-- .rowElem -->

    	<label>{lang_content_field}</label><br />
      <textarea class="js-trumbowyg" name="content">{content}</textarea>
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