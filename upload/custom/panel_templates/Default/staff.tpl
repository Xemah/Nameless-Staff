{include file='header.tpl'}

<body id="page-top">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		{include file='sidebar.tpl'}

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main content -->
			<div id="content">

				<!-- Topbar -->
				{include file='navbar.tpl'}

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">{$PAGE_TITLE}</h1>
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
							<li class="breadcrumb-item active">{$STAFF_SETTINGS}</li>
						</ol>
					</div>

					{if isset($SUCCESS)}
						<div class="alert alert-success">
							<h5>
								<i class="fas fa-check-circle fa-fw"></i>
								{$SUCCESS_TITLE}
							</h5>
							{$SUCCESS}
						</div>
					{/if}

					{if isset($ERROR)}
						<div class="alert alert-danger">
							<h5>
								<i class="fas fa-exclamation-circle fa-fw"></i>
								{$ERROR_TITLE}
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
											<label for="inputPageTitle">{$PAGETITLE}</label>
											<input type="text" name="pageTitle" class="form-control"
												value="{$SETTINGS.pageTitle}" id="inputPageTitle">
										</div>
										<div class="form-group">
											<label for="inputLinkPath">{$LINKPATH}</label>
											<input type="text" name="linkPath" class="form-control"
												value="{$SETTINGS.linkPath}" id="inputLinkPath">
										</div>
										<div class="form-group">
											<label for="inputLinkLocation">{$LINKLOCATION}</label>
											<select name="linkLocation" class="form-control" id="inputLinkLocation">
												<option value="1" {if ($SETTINGS.linkLocation == '1')} selected{/if}>
													{$NAVBAR}</option>
												<option value="2" {if ($SETTINGS.linkLocation == '2')} selected{/if}>
													{$NAVBARMOREDROPDOWN}</option>
												<option value="3" {if ($SETTINGS.linkLocation == '3')} selected{/if}>
													{$FOOTER}</option>
												<option value="4" {if ($SETTINGS.linkLocation == '4')} selected{/if}>
													{$NONE}</option>
											</select>
										</div>
										<div class="form-group">
											<label for="inputNavIcon">{$NAVICON}</label>
											<input type="text" name="navIcon" class="form-control"
												value="{$SETTINGS.navIcon}" id="inputNavIcon">
										</div>
										<div class="form-group">
											<label for="inputNavOrder">{$NAVORDER}</label>
											<input type="text" name="navOrder" class="form-control"
												value="{$SETTINGS.navOrder}" id="inputNavOrder">
										</div>
										<div class="text-right">
											<input type="hidden" name="token" value="{$TOKEN}">
											<input type="submit" class="btn btn-primary" value="{$SUBMIT}">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>

			</div>

			{include file='footer.tpl'}

		</div>

	</div>

	{include file='scripts.tpl'}

</body>

</html>