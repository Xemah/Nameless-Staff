{include file='header.tpl'}

<body class="hold-transition sidebar-mini">

	<style>
		.heading {
			display: flex;
			align-items: center;
		}
		.heading-prefix {
			position: absolute;
			font-size: 6rem;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: -2px;
			opacity: 0.03;
			user-select: none;
		}
		.heading-title {
			margin: 1rem 1.5rem;
		}
		.table td, .table th {
			vertical-align: middle;
		}
		.form-group label {
			width: 100%;
		}
		.form-group .switchery ~ label,
		.form-group input ~ label {
			width: auto;
		}
		.form-group label small {
			float: right;
			padding: 2px;
			transform: translateY(4px);
		}
	</style>

	<div class="wrapper">

		{include file='navbar.tpl'}
		{include file='sidebar.tpl'}
		
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row align-items-center mb-2">
						<div class="col-sm-6">
							<h1 class="heading text-dark">
								<span class="heading-prefix">{$TITLE}</span>
								<span class="heading-title">{$PAGE_TITLE}</span>
							</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
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
				</div>
			</div>
			
			<section class="content">
				<div class="container-fluid">

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