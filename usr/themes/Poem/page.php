<?php  $this->need('header.php');?> 
<section class="hero small accent parallax" style="background-image: url(<?php $this->options->themeUrl('images/parallax.png'); ?>);">
    <div class="hero-content container">
        <h1><?php $this->title() ?></h1>
    </div>
    <div class="sub-hero container">	<span class="line"></span>
    </div>
</section>
<div class="content container">
		<div class="row">
			<div class="title center col-sm-12">
				<p><?php $this->content(); ?></p>
			</div>
		</div>
        <?php include('comments.php'); ?>	
        </div>
<?php $this->need('footer.php'); ?>