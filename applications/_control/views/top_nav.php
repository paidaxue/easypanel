<div id="topNav">
	<div class="fixed">
		<div class="wrapper">
			<div class="welcome">
				<a href="{BASE_URL}/users/profile/{id_loggedUser}" title="{lang_top_profile}">
					<img src="{UP_URL}/general/{active_avatar}" alt="" class="avatar-img">
				</a>
				<span>{lang_top_welcome}, {active_full_name}!</span>
			</div>
			<div class="userNav">
				<ul>
					<li>
						<a href="{BASE_URL}/users" title="{lang_top_users}">
							<img src="{APP_URL}/images/topnav/register.png" alt="{lang_top_users}" />
							<span>{lang_top_users}</span>
						</a>
					</li>
					<li>
						<a href="{BASE_URL}/users/profile/{id_loggedUser}" title="{lang_top_profile}">
							<img src="{APP_URL}/images/topnav/profile.png" alt="{lang_top_profile}" />
							<span>{lang_top_profile}</span>
						</a>
					</li>
					<li>
						<a href="{BASE_URL}/settings" title="{lang_top_settings}">
							<img src="{APP_URL}/images/topnav/settings.png" alt="{lang_top_settings}" />
							<span>{lang_top_settings}</span>
						</a>
					</li>
					<li>
						<a href="{BASE_URL}/login/log_out" title="{lang_top_logout}">
							<img src="{APP_URL}/images/topnav/logout.png" alt="{lang_top_logout}" />
							<span>{lang_top_logout}</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="fix"></div>
		</div>
	</div>
</div>
