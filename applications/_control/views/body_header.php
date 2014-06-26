{TOP_NAV}

<div id="header" class="wrapper">
	<div class="logo">
		<a href="{BASE_URL}/dashboard">
			<img src="{APP_URL}/images/loginLogo.png" alt="logo" />
		</a>
	</div>
	<div id = "notifications"></div>
</div>

<div class="wrapper">
	<div class="leftNav">
		<ul id="menu">
			<li class = "dashboard">
				<a href="{BASE_URL}/dashboard" title="Dashboard">
					<span>Dashboard</span>
				</a>
			</li>

			<li class = "pages">
				<a href="{BASE_URL}/pages" title="Pages">
					<span>Pages</span>
				</a>
			</li>

			<li class = "sidebars">
				<a href="{BASE_URL}/sidebars" title="Sidebars">
					<span>Sidebars</span>
				</a>
			</li>

			<li class = "modules exp">
				<a href="#" title="Modules">
					<span>Modules</span>
					<span class = "numberLeft">{count_modules}</span>
				</a>
				<ul class="sub">
					{MODULES}
					<li>
						<a href="{BASE_URL}/{module_slug}" title="{name}">{name}</a>
					</li>
					{/MODULES}
				</ul>
			</li>

			<li class = "settings exp">
				<a href="#" title="Settings">
					<span>Settings</span>
				</a>
				<ul class="sub">
					<li>
						<a href="{BASE_URL}/settings" title="General settings">General settings</a>
					</li>

					<li>
						<a href="{BASE_URL}/settings/account/{id_loggedUser}" title="Account settings">Account settings</a>
					</li>

					<li>
						<a href="{BASE_URL}/settings/modules" title="Modules settings">Modules settings</a>
					</li>

					<li class="last">
						<a href="{BASE_URL}/settings/theme" title="Theme Settings">Theme settings</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
