<div class="navbar navbar-default">
  <div class="container">
    <a class="navbar-brand" href="{BASE_URL}">
			<img src="{UP_URL}/general/settings/{website_logo}" alt="Logo" title="Logo" width="70" />
    </a>

    <ul class="nav navbar-nav">
      {NAV}
      <li class="{active}">
      	<a href="{page_link}">{title}</a>

				<ul class="dropdown-menu" role="menu">
					{S_NAV}
					<li>
						<a href="{s_page_link}">{s_title}</a>
					</li>
					{/S_NAV}
				</ul>
      </li>
      {/NAV}
    </ul>
  </div>
</div>