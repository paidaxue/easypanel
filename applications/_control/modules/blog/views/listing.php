<div class="widget first">
  <div class="head">
    <h5 class="iFrames">{lang_page_title}</h5>
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
      {POSTS}
      <tr>
        <td>{title}</td>
        <td>
          <a href="{BASE_URL}/blog/edit/{id_post}">
            <button class="blackBtn">{lang_edit_column}</button><!-- .blackBtn -->
          </a>
        </td>
        <td>
          <button class="redBtn bConfirm post-delete" id="{id_post}">{lang_delete_column}</button><!-- .redBtn -->
        </td>
      </tr>
      {/POSTS}
    </tbody>
  </table>
</div><!-- .widget .first -->

<a href="{BASE_URL}/blog/add">
  <button class="blueBtn add outside-button">{lang_add_post}</button><!-- .blueBtn -->
</a>
