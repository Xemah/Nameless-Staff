{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="ui stackable grid">
  <div class="ui centered row">
    {if count($STAFF_GROUPS)}
      <div class="ui {if count($WIDGETS)}ten wide tablet twelve wide computer{else}sixteen wide{/if} column">
        {foreach from=$STAFF_GROUPS item=group}
          {if count($group.members)}
            <div class="ui fluid card" style="border-bottom: solid 1.5px {$group.style};">
              <div class="content">
                <div class="ui dividing header" style="color: {$group.style};">
                  {$group.name}
                </div>
                <div class="description">
                  <div class="ui stackable grid">
                    <div class="ui row" style="padding-bottom: 0;">
                      {foreach from=$group.members item=member}
                        <div class="ui four wide tablet three wide computer column">
                          <h4 class="ui center aligned icon header">
                            <img class="ui circular image" src="{$member.avatar}" alt="{$member.username}" style="display: block; margin: 0 auto .5rem; width: 60px; height: 60px;">
                            <a href="{$member.profile}" style="color: {$group.style};">{$member.username}</a>
                          </h4>
                        </div>
                      {/foreach}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          {/if}
        {/foreach}
      </div>
    {/if}
    {if count($WIDGETS)}
      <div class="ui six wide tablet four wide computer column">
        {foreach from=$WIDGETS item=widget}
          {$widget}
        {/foreach}
      </div>
    {/if}
  </div>
</div>

{include file='footer.tpl'}