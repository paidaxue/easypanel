<div class="widget first">
  <div class="head">
    <h5 class="iFrames">{lang_page_title}</h5>
  </div>

  <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic resize">
    <thead>
      <tr>
        <td width="80%">{lang_name}</td>
        <td>{lang_enable}</td>
        <td>{lang_delete}</td>
      </tr>
    </thead>

    <tbody>
      {THEMES}
      <tr>
        <td>{name}</td>
        <td>
          <button class="basicBtn enableTheme {selected}" id="{id_theme}" >{lang_verb}</button>
        </td>
        <td>
          <button class="redBtn bConfirm theme-delete" id="{id_theme}" >{lang_delete}</button>
        </td>
      </tr>
      {/THEMES}

    </tbody>
  </table>
</div>

