<?php $this->need('header.php'); ?>
<section class="hero small accent parallax" style="background-image: url(<?php $this->options->themeUrl('images/parallax.png'); ?>);">
    <div class="hero-content container">
        <h1><?php $this->title() ?></h1>
    </div>
    <div class="sub-hero container">	<span class="line"></span>
    </div>
</section>
<section class="content container">

		<div class="row">
			<div class="col-sm-8">
				<div class="post image">
					<span class="date"><?php $this->date('d'); ?><br><small><?php $this->date('M'); ?></small></span>
					<div class="post-title">
						<h2><?php $this->title() ?></h2>
						<div class="post-meta">
							<h6><?php $this->category(','); ?></h6>							
						</div>
					</div>
					<div class="post-body">
                    <?php $this->content(); ?>
					</div>			
					</div>
                    <?php include('comments.php'); ?>	
				</div>
<?php $this->need('sidebar.php'); ?>
</div>
</section>
<?php $this->need('footer.php'); ?>
