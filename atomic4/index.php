<?php
/**
 * @copyright	Copyright (C) 2019 Ron Severdia. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Get the application object for things like displaying the site name 
$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Get the alias of the current menu item
$active = JFactory::getApplication()->getMenu()->getActive();

// Get params from template
$params = $app->getTemplate(true)->params;

// Assign template params
$sitetitle							= $this->params->get('sitetitle');
$sitedescription					= $this->params->get('sitedescription');
$bodymenu							= $this->params->get('bodymenu');
$bootstrapsource					= $this->params->get('bootstrapsource');
$bootstrapcdn						= $this->params->get('bootstrapcdn');
$fontawesome						= $this->params->get('fontawesome');
$customcsscode						= $this->params->get('customcsscode');
$customcssfile						= $this->params->get('customcssfile');
$customjs							= $this->params->get('customjs');
$fluidcontainer						= $this->params->get('fluidcontainer');
$jqlibrary							= $this->params->get('jqlibrary');
$jquerycdn							= $this->params->get('jquerycdn');
$bsfixjoomla						= $this->params->get('bsfixjoomla');
$gacode								= $this->params->get('gacode');
$pageheader							= $this->params->get('pageheader');
$topmenu							= $this->params->get('topmenu');
$abovebody							= $this->params->get('abovebody');
$leftbody							= $this->params->get('leftbody');
$rightbody							= $this->params->get('rightbody');
$belowbody							= $this->params->get('belowbody');
$footer								= $this->params->get('footer');
$headerfont							= $this->params->get('headerfont');
$headerfontname						= $this->params->get('headerfontname');
$bodyfont							= $this->params->get('bodyfont');
$bodyfontname						= $this->params->get('bodyfontname');
$killjoomlajs						= $this->params->get('killjoomlajs');
$killjoomlacss						= $this->params->get('killjoomlacss');
$killgenerator						= $this->params->get('killgenerator');
$copyright							= $this->params->get('copyright');
$copyrighttxt						= $this->params->get('copyrighttxt');
$noconflict							= $this->params->get('noconflict');
$jqmigrate							= $this->params->get('jqmigrate');
$mootools							= $this->params->get('mootools');
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<jdoc:include type="head" />
		
		<?php		// Remove MooTools
			if($mootools == 0)  : ?>
				<?php $doc = JFactory::getDocument();
					unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
					unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
			?>
		<?php endif; ?>
		
		<?php		// Use jQuery noConflict()
			if($noconflict == 0)  : ?>
				<?php $doc = JFactory::getDocument();
					unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
			?>
		<?php endif; ?>
		
		<?php		// Use jQuery Migrate
			if ($jqmigrate != 0) : ?>
				<?php $doc = JFactory::getDocument();
					unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
			?>
		<?php endif; ?>
		
		<?php		// Use Joomla's jQuery 1.12.4 unless configured otherwise - Disabled for now
		//	if($jqlibrary > 0)  : ?>
				<?php //$doc = JFactory::getDocument();
			//		unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
			?>
		<?php // endif; ?>
		
		<?php		// Remove Joomla head scripts (third-party scripts will still load)
			if($killjoomlajs == 1) : ?>
				<?php $doc = JFactory::getDocument();
					unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
					unset($doc->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
					unset($doc->_scripts[JURI::root(true) . '/media/modals/js/script.min.js']);
					unset($doc->_scripts[JURI::root(true) . '/media/system/js/core.js']);
					unset($doc->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
					if (isset($this->_script['text/javascript'])) { 
						$this->_script['text/javascript'] = preg_replace('%window\.addEvent\    (\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%',     '', $this->_script['text/javascript']);
						if (empty($this->_script['text/javascript']))
							unset($this->_script['text/javascript']);
						}
			?>
		<?php endif; ?>
		
		<?php 		// Remove Joomla CSS file (Modal styles)
			if($killjoomlacss == 1) : ?>
			<?php $doc = JFactory::getDocument();
				unset($doc->_scripts[JURI::root(true) . '/media/modals/css/bootstrap.min.css']); ?>
		<?php endif; ?>

		<?php 		// Remove Joomla generator tag
			if($killgenerator == 1) : ?>
			<?php $this->setGenerator(null); ?>
		<?php endif; ?>
		
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	 	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   	 	
		<?php 		// Load remote Bootstrap 4 CSS framework from CDN
			if(($bootstrapcdn == null) && ($bootstrapsource == 1)) : ?>
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<?php elseif(($bootstrapcdn == null) && ($bootstrapsource == 2)) : ?>
				<?php echo $bootstrapcdn ?>
			<?php else : ?>
		<?php endif; ?>
		
		<?php 		// Load the local CSS fixes for Joomla & Bootstrap 4.
			if($bsfixjoomla == 1) : ?>
				<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_bs4.css" type="text/css" />
		<?php endif; ?>
		
		<?php 		// Load FontAwesome 5.5
			if($fontawesome == 1) : ?>
			<script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
		<?php elseif($fontawesome == 2) : ?>
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<?php endif; ?>
						
		<?php		/* Load Google Fonts  */		?>
		<?php if(($headerfont == 1) && ($bodyfont == 1) && ($headerfontname != null) && ($bodyfontname != null)) : ?>
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo $headerfontname; ?>|<?php echo $bodyfontname; ?>">
			<style>h1,h2,h3,h4,h5,h6{font-family:'<?php echo $headerfontname; ?>',serif;}body{font-family:'<?php echo $bodyfontname; ?>',serif;}</style>
		<?php elseif(($headerfont == 1) && ($bodyfont == 0) && ($headerfontname != null)) : ?>
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo $headerfontname; ?>">
			<style>h1,h2,h3,h4,h5,h6{font-family:'<?php echo $headerfontname; ?>',serif;}</style>
		<?php elseif(($headerfont == 0) && ($bodyfont == 1) && ($bodyfontname != null)) : ?>
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php echo $bodyfontname; ?>">
			<style>body{font-family:'<?php echo $bodyfontname; ?>',serif;}</style>
		<?php else : ?>
		<?php endif; ?>		
		
		<?php 		// Load the RTL CSS file.
			if($this->direction == 'rtl') : ?>
			<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_rtl.css" type="text/css" />
		<?php endif; ?>
		
		<?php 		// Load the local CSS file for custom user CSS.
			if($customcssfile == 1) : ?>
			<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
		<?php endif; ?>
		
		<?php 		// Add any custom user CSS from the configuration.
			if($customcsscode != null) : ?>
			<style>
				<?php echo $customcsscode ?>
			</style>
		<?php endif; ?>
	</head>
	
	<?php		/* Add the menu item alias to the body ID, class, or both  */		?>
	<?php if($bodymenu == 1) : ?>
		<body class="<?php echo $active->alias; ?> ">
	<?php elseif($bodymenu == 2) : ?>
		<body id="<?php echo $active->alias; ?> ">
	<?php elseif($bodymenu == 3) : ?>
		<body id="<?php echo $active->alias; ?>" class="<?php echo $active->alias; ?> ">
	<?php else : ?>
		<body>
	<?php endif; ?>
	
	<?php 		// Choose either a fixed or fluid width container
		if($fluidcontainer == 1) : ?>
		<div class="container-fluid">
	<?php else : ?>
		<div class="container">
	<?php endif; ?>
	
			<?php if($pageheader == 1) : ?>
			<div class="row">
				<div class="page-header">
					<h1><?php if($sitetitle == null) : ?><?php echo htmlspecialchars($app->getCfg('sitename')); ?>
						<?php else : ?><?php echo $sitetitle	; ?><?php endif; ?></h1>
						<?php if($sitedescription != null) : ?><p><small><?php echo $sitedescription	; ?></small></p><?php endif; ?>
				</div>
				<?php if ($this->countModules('menu')) : ?>
				<div class="menu">
					<jdoc:include type="modules" name="menu" />
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		
			<?php if($topmenu == 1) : ?>
			<div class="row">
				<div class="col-md-9">
					<nav class="navigation">
						<div class="nav-collapse">
							<jdoc:include type="modules" name="navigation" />
						</div>
					</nav>
				</div>
				<div class="col-md-3">
					<jdoc:include type="modules" name="search" />
				</div>
			</div>
			<?php endif; ?>
		
			<div class="row">
				<?php if(($leftbody == 1) && ($rightbody == 1)) : ?>	
				<div class="col-md-2">
					<jdoc:include type="modules" name="leftbody" />
				</div>
				<div class="col-md-8">
					<jdoc:include type="message" />
					<?php if($abovebody == 1) : ?>
					<jdoc:include type="modules" name="abovebody" />
					<?php endif; ?>
					<jdoc:include type="component" />
					<?php if($belowbody == 1) : ?>
					<jdoc:include type="modules" name="belowbody" />
					<?php endif; ?>
				</div>
				<div class="col-md-2">
					<jdoc:include type="modules" name="rightbody" />
				</div>
			
				<?php elseif(($leftbody == 0) && ($rightbody == 1)) : ?>
				<div class="col-md-10">
					<jdoc:include type="message" />
					<?php if($abovebody == 1) : ?>
					<jdoc:include type="modules" name="abovebody" />
					<?php endif; ?>
					<jdoc:include type="component" />
					<?php if($belowbody == 1) : ?>
					<jdoc:include type="modules" name="belowbody" />
					<?php endif; ?>
				</div>
				<div class="col-md-2">
					<jdoc:include type="modules" name="rightbody"  />
				</div>
		
				<?php elseif(($leftbody == 1) && ($rightbody == 0)) : ?>
				<div class="col-md-2">
					<jdoc:include type="modules" name="leftbody"  />
				</div>
				<div class="col-md-10">
					<jdoc:include type="message" />
					<?php if($abovebody == 1) : ?>
					<jdoc:include type="modules" name="abovebody" />
					<?php endif; ?>
					<jdoc:include type="component" />
					<?php if($belowbody == 1) : ?>
					<jdoc:include type="modules" name="belowbody" />
					<?php endif; ?>
				</div>
			
				<?php else : ?>
				<div class="col-md-12">
					<jdoc:include type="message" />
					<?php if($abovebody == 1) : ?>
					<jdoc:include type="modules" name="abovebody" />
					<?php endif; ?>
					<jdoc:include type="component" />
					<?php if($belowbody == 1) : ?>
					<jdoc:include type="modules" name="belowbody" />
					<?php endif; ?>
				</div>
				<?php endif; ?>
							
			</div>
		
			<?php if($footer == 1) : ?>
			<div class="row">
				<footer>
					<jdoc:include type="modules" name="footer" style="none" />
						<hr />
						<?php if(($copyrighttxt != null) && ($copyright == 1)) : ?>
						&copy;<?php echo date('Y'); ?> <?php echo $copyrighttxt ?>
						<?php else : ?>
						&copy;<?php echo date('Y'); ?> <?php echo htmlspecialchars($app->getCfg('sitename')); ?>
						<?php endif; ?>
				</footer>
			</div>
			<?php endif; ?>
		</div>
		
		<jdoc:include type="modules" name="debug" style="none" />
		
		<?php		/* Load jQuery 2 or 3 remotely.  */		?>
		<?php if (($jquerycdn == null) && ($jqlibrary == 1)) : ?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<?php elseif (($jquerycdn == null) && ($jqlibrary == 2)) : ?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<?php else : ?>
			<?php echo $jquerycdn ?>
		<?php endif; ?>		

		<?php		// Use jQuery Migrate 3.0.1
			if($jqmigrate == 1)  : ?>
				<script src="https://code.jquery.com/jquery-migrate-3.0.1.min.js" crossorigin="anonymous"></script>
		<?php endif; ?>
		
		<?php 		// Load the local or remote Bootstrap 3 or 4 JavaScript dependency
			 			// If CDN empty and load BS 3 remotely	
			if(($bootstrapcdn == null) && ($bootstrapsource == 1)) : ?>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			
			<?php 		// If CDN empty and load BS 4 remotely
				elseif(($bootstrapcdn == null) && ($bootstrapsource == 3)) : ?>
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
			
			<?php 		// If CDN empty and load BS 4 remotely, but full jQuery 3 is loaded
				elseif(($bootstrapcdn == null) && ($bootstrapsource == 3) && ($jqlibrary == 2)) : ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<?php else : ?>
		<?php endif; ?>
		
		<?php 		// Load custom local user JavaScript
			if($customjs == 1) : ?>
			<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/template.js"></script>
		<?php endif; ?>
		
		<?php 		// Add Google Analytics tag if configured.
			if($gacode != null) : ?>
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			  ga('create', '<?php echo $gacode; ?>', 'auto');
			  ga('send', 'pageview');
		</script>
		<?php endif; ?>
	</body>
</html>