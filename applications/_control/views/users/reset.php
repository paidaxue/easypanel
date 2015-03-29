<form action="{BASE_URL}/users/change_pass/{id_loggedUser}" method="post" class="mainForm" enctype="multipart/form-data">
	<fieldset>
  	<div class="widget first">
			<div class="head">
				<h5>{lang_page_title}</h5>
			</div>

			<div class="rowElem">
				<label>{lang_newpass}</label>
				<div class="formRight">
					<input type="password" name="new_password" id="new_password" />
				</div>
			</div>

			<div class="rowElem">
				<label>{lang_confirmpass}</label>
				<div class="formRight">
					<input type="password" name="confirm_password" id="confirm_password" />
				</div>

			<div class="rowElem">
				<input type="submit" value="Submit" id="rese_submit" class="basicBtn submitForm" />
				<div class="fix"></div>
			</div>
		</div>
  </fieldset>
</form>