<div class="widget first">
  <div class="head">
    <h5 class="iFrames">{lang_page_title}</h5>
  </div><!-- .head -->

  <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic resize">
    <thead>
      <tr>
        <td width="80%">{lang_name}</td>
        <td>{lang_slug}</td>
        <td>{lang_delete}</td>
      </tr>
    </thead>

    <tbody>
      {MODULES}
      <tr>
        <td>{name}</td>
        <td>{module_slug}</td>
        <td>
          <button class="redBtn bConfirm module-delete" id = "{id_module}" >{lang_delete}</button>
        </td>
      </tr>
      {/MODULES}

    </tbody>
  </table>
</div><!-- .widget .first -->

