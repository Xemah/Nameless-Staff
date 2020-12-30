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
			
				<div class="row align-items-center mb-3">
					<div class="col-sm-6">
						<h1 class="h3 mb-0 text-gray-800">{$PAGE_TITLE}</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right mb-0">
							{foreach from=$BREADCRUMBS item=breadcrumb name=name}
								{if (!$smarty.foreach.name.last)}
									<li class="breadcrumb-item">
										{if !empty($breadcrumb.link)}
											<a href="{$breadcrumb.link}">{$breadcrumb.name}</a>
										{else}
											{$breadcrumb.name}
										{/if}
									</li>
								{else}
									<li class="breadcrumb-item active">
										{$breadcrumb.name}
									</li>
								{/if}
							{/foreach}
						</ol>
					</div>
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