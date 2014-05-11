<form action = "{BASE_URL}/settings/theme_process" method="post" class="mainForm">
  <fieldset>
    <div class="widget first">
      <div class="head">
        <h5 class="iFrames">{lang_page_title}</h5>
      </div><!-- .head -->

      <div class="rowElem nobg">
        <label>{lang_content_type_field}</label>
        <div class="formRight noSearch">
          <select name="themes" class = "chzn-select" id = "themes" >
            {THEMES}
            <option value="{id_theme}" {selected}>{name}</option>
            {/THEMES}
          </select>
        </div><!-- .formRight -->
        <div class="fix"></div>
      </div><!-- .rowElem -->

      <div class="rowElem">
        <div class="formRight submitRight" id="submit-theme-select">
            <input type="submit" value="{lang_submit_form}" class="basicBtn" />
        </div><!-- .formRight -->        
        <div class="fix"></div>
      </div>
    </div>
  </fieldset>
</form>

<form action = "{BASE_URL}/settings/refresh_themes" method="post" class="mainForm">
  <div class="formRight submitRight">
    <input type="submit" value="{lang_refresh_themes}" class="blackBtn" id="refresh_theme"/>
  </div><!-- .formRight -->
</form>