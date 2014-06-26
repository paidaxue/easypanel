<form action="{BASE_URL}/settings/theme_process" method="post" class="mainForm">
  <fieldset>
    <div class="widget first">
      <div class="head">
        <h5 class="iFrames">{lang_page_title}</h5>
      </div>

      <div class="rowElem nobg">
        <label>{lang_select_theme}</label>
        <div class="formRight noSearch">
          <select name="themes" class = "chzn-select" id = "themes" >
            <option value="0">{lang_default}</option>
            {THEMES}
            <option value="{id_theme}" {selected}>{name}</option>
            {/THEMES}
          </select>
        </div>
        <div class="fix"></div>
      </div>

      <div class="rowElem">
        <div class="formRight submitRight" id="submit-theme-select">
            <input type="submit" value="{lang_submit}" class="basicBtn" />
        </div>
        <div class="fix"></div>
      </div>
    </div>
  </fieldset>
</form>