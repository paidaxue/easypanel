<div class="loginWrapper">
	<div class="loginLogo">
		<img src="{APP_URL}/images/loginLogo.png" alt="Logo" />
	</div>

	<div class="loginPanel">
		<div class="head">
			<h5 class="iUser">{lang_page_title}</h5>
		</div>

		<div class="form">
			<form class="mainForm" id="loginForm" >
				<fieldset>
					<div class="loginRow">
						<label>{lang_user_field}</label>

						<div class="loginInput nobg">
							<input type="text" name="user" id="user" />
						</div><!-- .loginInput -->

						<div class="inputError" id = "username">
							<label class="error" id="required">{lang_required_input}</label>
						</div>

						<div class="fix"></div>
					</div>

					<div class="loginRow">
						<label>{lang_pass_field}</label>

						<div class="loginInput nobg">
							<input type="password" name="pass" id="pass" />
						</div>

						<div class="inputError" id = "password">
							<label class="error" id="required">{lang_required_input}</label>
						</div>

						<div class="fix"></div>
					</div>

					<div class="loginRow">
						<div id = "log_in_error">
							<p>{lang_incorrect_login}</p>
						</div>

						<input type="submit" value="{lang_submit_login}" class="basicBtn submitForm" id="log_in" />
						<div class="fix"></div>
					</div>

				</fieldset>
			</form>
		</div>
	</div>
</div>