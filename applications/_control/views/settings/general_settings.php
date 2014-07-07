<form action="{BASE_URL}/settings/general_process" method="post" class="mainForm" enctype="multipart/form-data">
	<fieldset>
  	<div class="widget first">
			<div class="head">
				<h5>{lang_page_title}</h5>
			</div>

			<div class="rowElem nobg">
				<label>{lang_website_title}</label>
				<div class="formRight">
					<input type="text" name="website_title" value="{website_title}" />
				</div>

				<div class="fix"></div>
			</div>

			<div class="rowElem nobg">
				<label>{lang_website_homepage}</label>
				<div class="formRight">
					<select name="website_homepage" id = "homepage" >
						{PAGES}
            <option value="{id_page}" {selected}>{title}</option>
						{/PAGES}
          </select>
        </div>

				<div class="fix"></div>
			</div>

			<div class="rowElem">
				<label>{lang_website_logo}</label>
				<div class="formRight">
					<div class="pics single">
					   <ul>
							<li>
								<a href="#" title="{lang_website_logo}" class = "img">
									<img src="{UP_URL}/general/{website_logo}" alt="" />
								</a>

								<div class="actions">
									<a href="#">
										<img src="{APP_URL}/images/edit.png" alt="" />
										<input type = "file" name = "website_logo" class = "default" />
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>

				<div class="fix"></div>
			</div>

			<div class="rowElem">
				<label>{lang_website_copyright}</label>
				<div class="formRight">
					<textarea class="ckeditor" cols="80" id="editor1" rows="10" name="website_copyright">{website_copyright}</textarea>
				</div>
				<div class="fix"></div>
			</div>

			<div class="rowElem">
				<input type="submit" value="Submit" id="submit" class="basicBtn submitForm" />
				<div class="fix"></div>
			</div>
		</div>
  </fieldset>
</form>