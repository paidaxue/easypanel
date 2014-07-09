<form action="{BASE_URL}/users/profile_process/{id_loggedUser}" method="post" class="mainForm" enctype="multipart/form-data">
	<fieldset>
  	<div class="widget first">
			<div class="head">
				<h5>{lang_page_title}</h5>
			</div>

		  <div class="rowElem">
			  <label>{lang_user_avatar}</label>
				<div class="formRight">
					<div class="pics single">
					   <ul>
							<li>
								<a href="#" title="{lang_user_avatar}" class = "img">
									<img src="{UP_URL}/general/{avatar}" alt="Profile Picture" />
								</a>

								<div class="actions">
									<a href="#">
										<img src="{APP_URL}/images/edit.png" alt="" />
										<input type = "file" name = "avatar" class = "default" />
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="rowElem">
				<label>{lang_fullname}</label>
				<div class="formRight">
					<input type="text" name="fullname" value="{fullname}" id="fullname" />
				</div>
			</div>

			<div class="rowElem">
				<label>{lang_username}</label>
				<div class="formRight">
					<input type="text" name="user" value="{user}" id="user" />
				</div>

				<div class="inputError" id="username">
					<label class="error" id="required">{lang_required_input}</label>
				</div>
				<div class="fix"></div>
			</div>

			<div class="rowElem">
				<label>{lang_email}</label>
				<div class="formRight">
					<input type="text" name="email" value="{email}" id="email" />
				</div>
			</div>

			<div class="rowElem">
				<input type="submit" value="Submit" id="user_submit" class="basicBtn submitForm" />
				<div class="fix"></div>
			</div>
		</div>
  </fieldset>
</form>