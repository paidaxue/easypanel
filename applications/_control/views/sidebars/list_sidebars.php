<div class="widget first">

	<div class="head">

		<h5 class="iFrames">{lang_sidebar_title}</h5>

	</div><!-- .head -->

	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic resize">

  	<thead>

    	<tr>

        <td width="80%">{lang_title_column}</td>
      	<td>{lang_edit_column}</td>
      	<td>{lang_delete_column}</td>

    	</tr>

  	</thead>

   	<tbody>

			{SIDEBARS}

    	<tr>

      	<td>{name}</td>
      	<td>

					<a href="{BASE_URL}/sidebars/edit/{id_sidebar}">

						<button class="blackBtn" >{lang_edit_column}</button><!-- .blackBtn -->

					</a>

				</td>
      	<td>

					<button class="redBtn bConfirm sidebar-delete" id = "{id_sidebar}" >{lang_delete_column}</button><!-- .redBtn -->

				</td>

    	</tr>
			{/SIDEBARS}

   	</tbody>

	</table>

</div><!-- .widget .first -->

<a href="{BASE_URL}/sidebars/add">

	<button class="blueBtn outside-button" >{lang_add_sidebar}</button><!-- .blueBtn -->

</a>
