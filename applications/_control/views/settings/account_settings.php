<form action="{BASE_URL}/settings/account_process/{id_loggedUser}" method="post" class="mainForm" enctype="multipart/form-data">
	<fieldset>
  	<div class="widget first">
			<div class="head">
				<h5>{lang_page_title}</h5>
			</div>

			<div class="rowElem">
				<label>{lang_username}</label>
				<div class="formRight">
					<input type="text" name="user" value="{user}" id="user" />
				</div>

				<div class="inputError" id = "username">
					<label class="error" id="required">{lang_required_input}</label>
				</div>
				<div class="fix"></div>
			</div>

			<div class="rowElem">
				<label>{lang_password}</label>
				<div class="formRight">
					<input type="password" name="pass" />
				</div>

				<div class="fix"></div>
			</div>

			<div class="rowElem">
				<input type="submit" value="Submit" id="user_submit" class="basicBtn submitForm" />
				<div class="fix"></div>
			</div>
		</div>
  </fieldset>
</form>