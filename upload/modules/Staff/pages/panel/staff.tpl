{include file='header.tpl'}

<body id="page-top">

<div id="wrapper">

	{include file='sidebar.tpl'}

	<div id="content-wrapper" class="d-flex flex-column">

		<div id="content">

			{include file='navbar.tpl'}

			<div class="container-fluid">

				<div class="row align-items-center mb-4">
					<div class="col-sm-6">
						<h1 class="h3 mb-0 text-gray-800">{$PAGE_TITLE}</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right mb-0">
							<li class="breadcrumb-item">
								<a href="{$SITE_HOME}panel">{$STAFF_LANGUAGE.dashboard}</a>
							</li>
							<li class="breadcrumb-item">
								{$STAFF_LANGUAGE.settings}
							</li>
						</ol>
					</div>
				</div>

				{if isset($SUCCESS)}
					<div class="alert alert-success">
						<h5>
							<i class="fas fa-check-circle fa-fw"></i>
							{$STAFF_LANGUAGE.success}
						</h5>
						{$SUCCESS}
					</div>
				{/if}

				{if isset($ERROR)}
					<div class="alert alert-danger">
						<h5>
							<i class="fas fa-exclamation-circle fa-fw"></i>
							{$STAFF_LANGUAGE.error}
						</h5>
						{$ERROR}
					</div>
				{/if}

				<div class="card shadow">
					<div class="card-body">
						<form method="post">
							<div class="row justify-content-center">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputPageTitle">{$STAFF_LANGUAGE.pageTitle}</label>
										<input type="text" name="pageTitle" class="form-control" value="{$SETTINGS.pageTitle}" id="inputPageTitle">
									</div>
									<div class="form-group">
										<label for="inputLinkPath">{$STAFF_LANGUAGE.linkPath}</label>
										<input type="text" name="linkPath" class="form-control" value="{$SETTINGS.linkPath}" id="inputLinkPath">
									</div>
									<div class="form-group">
										<label for="inputLinkLocation">{$STAFF_LANGUAGE.linkLocation}</label>
										<select name="linkLocation" class="form-control" id="inputLinkLocation">
											<option value="1"{if ($SETTINGS.linkLocation == '1')} selected{/if}>{$STAFF_LANGUAGE.navbar}</option>
											<option value="2"{if ($SETTINGS.linkLocation == '2')} selected{/if}>{$STAFF_LANGUAGE.navbarMoreDropdown}</option>
											<option value="3"{if ($SETTINGS.linkLocation == '3')} selected{/if}>{$STAFF_LANGUAGE.footer}</option>
											<option value="1"{if ($SETTINGS.linkLocation == '0')} selected{/if}>{$STAFF_LANGUAGE.none}</option>
										</select>
									</div>
									<div class="form-group">
										<label for="inputNavIcon">{$STAFF_LANGUAGE.navIcon}</label>
										<input type="text" name="navIcon" class="form-control" value="{$SETTINGS.navIcon}" id="inputNavIcon">
									</div>
									<div class="form-group">
										<label for="inputNavOrder">{$STAFF_LANGUAGE.navOrder}</label>
										<input type="text" name="navOrder" class="form-control" value="{$SETTINGS.navOrder}" id="inputNavOrder">
									</div>
									<div class="text-right">
										<input type="hidden" name="token" value="{$TOKEN}">
										<input type="submit" class="btn btn-primary" value="{$STAFF_LANGUAGE.submit}">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div style="height: 1rem;"></div>

			</div>

		</div>

		{include file='footer.tpl'}

	</div>

</div>

{include file='scripts.tpl'}

</body>
</html>