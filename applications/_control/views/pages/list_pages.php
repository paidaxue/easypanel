<div class="widget first">
	<div class="head">
		<h5 class="iFrames">{lang_page_title}</h5>
	</div>

	<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic resize">
  	<thead>
    	<tr>
        <td width="80%">{lang_title_column}</td>
      	<td>{lang_edit_column}</td>
      	<td>{lang_delete_column}</td>
    	</tr>
  	</thead>

   	<tbody>
			{PAGES}
    	<tr>
      	<td>{title}</td>
      	<td>
					<a href="{BASE_URL}/pages/edit/{id_page}">
						<button class="blackBtn" >{lang_edit_column}</button>
					</a>
				</td>
      	<td>
					<button class="redBtn bConfirm page-delete" id = "{id_page}" >{lang_delete_column}</button>
				</td>
    	</tr>
			{/PAGES}
   	</tbody>
	</table>
</div>

<a href="{BASE_URL}/pages/add">
	<button class="blueBtn outside-button" >{lang_add_page}</button>
</a>
