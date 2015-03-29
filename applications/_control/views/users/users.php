<div class="widget first">
  <div class="head">
    <h5 class="iFrames">{lang_page_title}</h5>
  </div>

  <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic resize">
    <thead>
      <tr>
        <td width="80%">{lang_fullname}</td>
        <td>Email</td>
        <td>{lang_edit}</td>
        <td>{lang_delete}</td>
      </tr>
    </thead>

    <tbody>
      {USERS}
      <tr>
        <td>{fullname}</td>
        <td>{email}</td>
        <td>
          <a href="{BASE_URL}/users/edit_profile/{id_user}">
            <button class="basicBtn" id="{id_user}">{lang_edit}</button>
          </a>
        </td>
        <td>
          <button class="redBtn bConfirm user-delete" id="{id_user}" >{lang_delete}</button>
        </td>
      </tr>
      {/USERS}

    </tbody>
  </table>
</div>

<a href="{BASE_URL}/users/register">
  <button class="blueBtn outside-button" >{lang_register_user}</button>
</a>
