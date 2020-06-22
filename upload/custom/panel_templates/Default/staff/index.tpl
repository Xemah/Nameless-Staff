{include file='staff/includes/header.tpl'}
				
<div class="card">
	<div class="card-body">
		{if count($FIELDS)}
			<form action="" method="post">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						{foreach from=$FIELDS item=field name=name}
							{include file="staff/includes/fields.tpl"}
						{/foreach}
						<div class="text-right">
							<input type="hidden" name="token" value="{$TOKEN}">
							<input type="submit" class="btn btn-primary" value="{$SUBMIT}">
						</div>
					</div>
				</div>
			</form>
		{/if}
	</div>
</div>
	
{include file='staff/includes/footer.tpl'}