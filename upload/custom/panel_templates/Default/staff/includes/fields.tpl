<div class="form-group{if ($field.type == 'color')} groupColour{/if}">

	{if ($field.type == 'radio')}
	
		{if count($field.options)}
			<label for="{$field.id}">{$field.label}{if ($field.meta)}<small class="text-muted">{$field.meta}</small>{/if}</label>
			<div class="d-flex justify-content-between">
				{foreach from=$field.options item=option name=name}
					<div>
						<input type="{$field.type}" name="{$field.name}" id="{$option.id}" value="{$option.id}"{if ($field.value == $option.value)} checked{/if}>
						<label for="{$option.id}">{$option.label}</label>
					</div>
				{/foreach}
			</div>
		{/if}

	{elseif ($field.type == 'select')}

		{if count($field.options)}
			<label for="{$field.id}">{$field.label}{if ($field.meta)}<small class="text-muted">{$field.meta}</small>{/if}</label>
			{if ($field.listed)}
				<select name="{$field.name}[]" class="form-control" id="{$field.id}" size="5" multiple>
					{foreach from=$field.options item=option name=name}
						<option value="{$option.value}"{if in_array($option.value, $field.value)} selected{/if}>{$option.label}</option>
					{/foreach}
				</select>
			{else}
				<select name="{$field.name}" class="form-control" id="{$field.id}">
					{foreach from=$field.options item=option name=name}
						<option value="{$option.value}"{if ($field.value == $option.value)} selected{/if}>{$option.label}</option>
					{/foreach}
				</select>
			{/if}
		{/if}

	{elseif ($field.type == "checkbox")}

		<input type="hidden" name="{$field.name}" value="0">
		<input type="checkbox" name="{$field.name}" class="js-switch js-check-change" id="{$field.id}" value="1"{if ($field.value == 1)} checked{/if}>
		<label for="{$field.id}" class="d-inline">{$field.label}</label>
		{if ($field.meta)} <small class="d-block text-muted mt-1">{$field.meta}</small>{/if}

	{elseif ($field.type == 'textarea')}

		<label for="{$field.id}">{$field.label}{if ($field.meta)}<small class="text-muted">{$field.meta}</small>{/if}</label>
		<textarea name="{$field.name}" class="form-control" id="{$field.id}" rows="5">{$field.value}</textarea>
	
	{elseif ($field.type == 'code')}

		<textarea name="{$field.name}" id="{$field.id}">{$field.value}</textarea>
	
	{elseif ($field.type == 'file')}

		<div class="custom-file">
			<input type="file" name="{$field.name}" class="custom-file-input" id="{$field.id}" onchange="$(this).next().text($(this)[0].files[0].name);">
			<label for="{$field.id}" class="custom-file-label">{$field.label}</label>
		</div>
	
	{elseif ($field.type == 'color')}

		<label for="{$field.id}">{$field.label}{if ($field.meta)}<small class="text-muted">{$field.meta}</small>{/if}</label>
		<div class="input-group">
			<input type="text" name="{$field.name}" class="form-control" id="{$field.id}" value="{$field.value}">
			<span class="input-group-append">
				<span class="input-group-text colorpicker-input-addon"><i></i></span>
			</span>
		</div>
	
	{else}

		<label for="{$field.id}">{$field.label}{if ($field.meta)}<small class="text-muted">{$field.meta}</small>{/if}</label>
		{if ($field.pre)}
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="{$field.id}">{$field.pre}</span>
				</div>
				<input type="{$field.type}" name="{$field.name}" class="form-control" id="{$field.id}" value="{$field.value}">
			</div>
		{else}
			<input type="{$field.type}" name="{$field.name}" class="form-control" id="{$field.id}" value="{$field.value}">
		{/if}
	
	{/if}

</div>