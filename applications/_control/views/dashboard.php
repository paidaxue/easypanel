<div class="title">
	<h5>{lang_page_title}</h5>
</div>

<div class = "left">
	<!-- Website statistics -->
	<div class="widget">
		<div class="head"><h5 class="iChart8">{lang_website_records}</h5></div>
		<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
			<thead>
				<tr>
				  <td width="21%">{lang_amount}</td>
				  <td>{lang_records_added}</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="center"><a href="#" title="" class="webStatsLink">{pages_no}</a></td>
					<td align="center">{page_record_name}</td>
				</tr>
				<tr>
					<td align="center"><a href="#" title="" class="webStatsLink">{users_no}</a></td>
					<td align="center">{users_record_name}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div><!-- left -->

<div class = "right">
	<!-- Website statistics -->
	<div class="widget">
		<div class="head"><h5 class="iChart8">{lang_modules}</h5></div>
		<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
				<thead>
					<tr>
					  <td>{lang_modules_added}</td>
					</tr>
				</thead>
				<tbody>
					{modules}
						<tr>
							<td align="center">{name}</td>
						</tr>
					{/modules}
				</tbody>
		</table>
	</div>
</div><!-- right -->
