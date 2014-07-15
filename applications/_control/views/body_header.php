{TOP_NAV}

<div id="header" class="wrapper">
	<div class="logo">
		<a href="{BASE_URL}/dashboard">
			<img src="{APP_URL}/images/loginLogo.png" alt="logo" />
		</a>
	</div>
	<div id = "notifications"></div><!-- notifications -->
</div>

<div class="wrapper">
	<div class="leftNav">
		<ul id="menu">
			<li class = "dashboard">
				<a href="{BASE_URL}/dashboard" title="{lang_nav_dashboard}">
					<span>{lang_nav_dashboard}</span>
				</a>
			</li>

			<li class = "pages">
				<a href="{BASE_URL}/pages" title="{lang_nav_pages}">
					<span>{lang_nav_pages}</span>
				</a>
			</li>

			<li class = "sidebars">
				<a href="{BASE_URL}/sidebars" title="{lang_nav_sidebars}">
					<span>{lang_nav_sidebars}</span>
				</a>
			</li>

			<li class = "modules exp">
				<a href="#" title="{lang_nav_dashboard}">
					<span>{lang_nav_modules}</span>
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
				<a href="#" title="{lang_nav_settings}">
					<span>{lang_nav_settings}</span>
				</a>
				<ul class="sub">
					<li>
						<a href="{BASE_URL}/settings/modules" title="Modules settings">{lang_nav_module_settings}</a>
					</li>

					<li class="last">
						<a href="{BASE_URL}/settings/theme" title="Theme Settings">{lang_nav_theme_settings}</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
